<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Order;

class ManageOrderTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  /** Helper Product Assign **/
  private function retrieveProducts($howMany = 1, $quantity = false, $sync = false, $parameters = [])
  {
    $products = collect(factory('App\Product', $howMany)->create($parameters));

    if($sync) return $products->mapWithKeys(function($product) use($quantity){
      return [$product->id => [
          'quantity' => $quantity !== false ? $quantity : $this->getRandQuantity($product->selling_type),
          'buyed_price' => $product->price
        ]];
    })->toArray();

    return $products->map(function($product) use($quantity){
      return [
          'quantity' => $quantity !== false ? $quantity : $this->getRandQuantity($product->selling_type),
          'id' => $product->id
        ];
    })->toArray();
  }

  /** @test **/
  public function guest_cannot_manage_orders()
  {
    $order = factory('App\Order')->create();

    $this->get('/administracion/pedidos')->assertRedirect('login');
    $this->get('/administracion/pedidos/crear')->assertRedirect('login');
    $this->get($order->path())->assertRedirect('login');
    $this->get("{$order->path()}/editar")->assertRedirect('login');
    $this->post('/administracion/pedidos')->assertRedirect('login');
    $this->put($order->path())->assertRedirect('login');
    $this->post("{$order->path()}/status")->assertRedirect('login');
  }

  /** @test **/
  public function a_user_can_view_the_orders()
  {
    $this->signIn();
    $order = factory('App\Order')->create();

    $this->get('/administracion/pedidos')->assertOk();
    $this->get($order->path())->assertOk();
  }

  /** @test **/
  public function a_user_can_create_a_order()
  {
    $this->signIn();
    $this->get('/administracion/pedidos/crear')->assertOk();


    $attributes = factory('App\Order')->raw();
    $attributes['products'] = $this->retrieveProducts();
    $this->post('/administracion/pedidos', $attributes)->assertRedirect('/administracion/pedidos');
  }

  /** @test **/
  public function a_user_can_update_a_order()
  {
    $this->signIn();
    $order = factory('App\Order')->create();
    $order->products()->sync($this->retrieveProducts(3, false, true));
    $this->assertEquals($order->fresh()->products->count(), 3);

    $this->get("{$order->path()}/editar")->assertOk();
  }

  /** @test **/
  public function a_user_can_update_order_products()
  {
    $this->signIn();
    $order = factory('App\Order')->create();
    $order->products()->sync($this->retrieveProducts(3, false, true));
    $newProducts = array_merge($this->retrieveProducts(5), $order->products->map(function($product){
      return ['id' => $product->id, 'quantity' => $product->pivot->quantity];
    })->toArray());

    $this->put($order->path(), array_merge($order->toArray(), ['products' => $newProducts]));
    $this->assertEquals($order->fresh()->products->count(), 8);
  }

  /** @test **/
  public function a_user_can_change_order_status()
  {
    $this->signIn();
    $order = factory('App\Order')->create();
    $this->post("{$order->path()}/status", ['status' => 1])->assertRedirect();
    $this->post("{$order->path()}/status", ['status' => 5])->assertSessionHasErrors('status');
  }

  /** @test **/
  public function a_order_required_a_name()
  {
    $this->signIn();
    $attributes = factory('App\Order')->raw(['name' => null]);

    $this->post('/administracion/pedidos', $attributes)->assertSessionHasErrors('name');
  }

  /** @test **/
  public function a_order_required_a_valid_email()
  {
    $this->signIn();
    $attributes = factory('App\Order')->raw(['email' => null]);

    $this->post('/administracion/pedidos', $attributes)->assertSessionHasErrors('email');
    $attributes['email'] = 'ThisEmailIsNotValid.com';
    $this->post('/administracion/pedidos', $attributes)->assertSessionHasErrors('email');
  }

  /** @test **/
  public function a_order_required_a_phone()
  {
    $this->signIn();
    $attributes = factory('App\Order')->raw(['phone' => null]);

    $this->post('/administracion/pedidos', $attributes)->assertSessionHasErrors('phone');
  }

  /** @test **/
  public function a_order_required_a_address()
  {
    $this->signIn();
    $attributes = factory('App\Order')->raw(['address' => null]);

    $this->post('/administracion/pedidos', $attributes)->assertSessionHasErrors('address');
  }

  /** @test **/
  public function a_order_required_a_valid_status()
  {
    $this->signIn();
    $attributes = factory('App\Order')->raw(['status' => null]);
    $attributes['products'] = $this->retrieveProducts();

    $this->post('/administracion/pedidos', $attributes)->assertSessionHasErrors('status');
    $attributes['status'] = 5;
    $this->post('/administracion/pedidos', $attributes)->assertSessionHasErrors('status');
    $attributes['status'] = 4;
    $this->post('/administracion/pedidos', $attributes)->assertSessionHasNoErrors();
  }

  /** @test **/
  public function a_order_required_a_valid_product()
  {
    $this->signIn();
    $attributes = factory('App\Order')->raw();
    $product = factory('App\Product')->create();

    $this->post('/administracion/pedidos', $attributes)->assertSessionHasErrors('products');

    $attributes['products'] = [['id' => $product->id, 'quantity' => 1]];
    $this->post('/administracion/pedidos', $attributes)->assertSessionHasNoErrors();

    $attributes['products'] = [['id' => $product->id, 'quantity' => 0]];
    $this->post('/administracion/pedidos', $attributes)->assertSessionHasErrors('products.0.quantity');

    $attributes['products'] = [['id' => $product->id, 'quantity' => null]];
    $this->post('/administracion/pedidos', $attributes)->assertSessionHasErrors('products.0.quantity');

    $attributes['products'] = [['id' => 8, 'quantity' => 1]];
    $this->post('/administracion/pedidos', $attributes)->assertSessionHasErrors('products.0.id');

    $attributes['products'] = [['id' => null, 'quantity' => 1]];
    $this->post('/administracion/pedidos', $attributes)->assertSessionHasErrors('products.0.id');
  }

  /** @test **/
  public function a_order_with_validate_stock_required_a_product_with_enough_stock()
  {
    $this->signIn();
    $product = factory('App\Product')->create(['validate_stock' => 1]);
    $attributes = factory('App\Order')->raw(['products' => [['id' => $product->id, 'quantity' => 1]]]);

    $this->post('/administracion/pedidos', $attributes)->assertSessionHasErrors('products.0.quantity');
    $this->put(factory('App\Order')->create()->path(), $attributes)->assertSessionHasErrors('products.0.quantity');
  }

  /** @test **/
  public function an_order_with_validate_stock_reduces_or_increases_the_product_stock_correctly()
  {
    $this->signIn();
    $product = factory('App\Product')->create(['validate_stock' => 1, 'stock' => 10]);
    $attributes = factory('App\Order')->raw(['products' => [['id' => $product->id, 'quantity' => 5]]]);

    $this->post('/administracion/pedidos', $attributes);
    $this->assertEquals($product->fresh()->stock, 5);

    $attributes['products'][0]['quantity'] = 10;
    $this->put(Order::first()->path(), $attributes);
    $this->assertEquals($product->fresh()->stock, 0);

    $attributes['products'][0]['quantity'] = 3;
    $this->put(Order::first()->path(), $attributes);
    $this->assertEquals($product->fresh()->stock, 7);
  }

  /** @test **/
  public function a_order_with_stock_exception_does_not_require_stock_validation()
  {
    $this->signIn();
    $product = factory('App\Product')->create(['validate_stock' => 1]);
    $attributes = factory('App\Order')->raw(['products' => [['id' => $product->id, 'quantity' => 100]], 'stock_exception' => 1]);

    $this->post('/administracion/pedidos', $attributes)->assertSessionHasNoErrors()->assertRedirect();

    $attributes['products'][0]['quantity'] = 5000;
    $this->put(Order::first()->path(), $attributes)->assertSessionHasNoErrors()->assertRedirect();
  }

  /** @test **/
  public function a_order_with_stock_exception_do_not_reduce_or_increases_the_product_stock()
  {
    $this->signIn();
    $product = factory('App\Product')->create(['validate_stock' => 1, 'stock' => 2000]);
    $attributes = factory('App\Order')->raw(['products' => [['id' => $product->id, 'quantity' => 1000]], 'stock_exception' => 1]);

    $this->post('/administracion/pedidos', $attributes);
    $this->assertEquals($product->fresh()->stock, 2000);

    $this->put(Order::first(), $attributes);
    $this->assertEquals($product->fresh()->stock, 2000);
  }

  /** @test **/
  public function a_order_with_validate_stock_must_increase_product_stock_by_quantity_of_product_removed()
  {
    $this->signIn();
    $order = factory('App\Order')->create();
    $order->products()->sync($this->retrieveProducts(2, 300, true, ['validate_stock' => 1, 'stock' => 500]));

    $productRemoved = $order->products->first();
    $this->put($order->path(), array_merge($order->toArray(), ['products' => [['id' => $order->products->last()->id, 'quantity' => 300]]]));
    $this->assertEquals($productRemoved->fresh()->stock, 800);
  }

}
