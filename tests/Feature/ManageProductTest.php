<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;

class ManageProductTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  /** @test **/
  public function guest_cannot_manage_products()
  {
    $product = factory('App\Product')->create();

    $this->get('/administracion/productos')->assertRedirect('login');
    $this->get('/administracion/productos/crear')->assertRedirect('login');
    $this->get($product->path())->assertRedirect('login');
    $this->get("{$product->path()}/editar")->assertRedirect('login');
    $this->post('/administracion/productos')->assertRedirect('login');
    $this->put($product->path())->assertRedirect('login');
    $this->delete($product->path())->assertRedirect('login');
  }

  /** @test **/
  public function a_user_can_view_the_products()
  {
    $this->signIn();
    $product = factory('App\Product')->create();

    $this->get('/administracion/productos')->assertOk();
    $this->get($product->path());
  }

  /** @test **/
  public function a_user_can_create_a_product()
  {
    $this->signIn();
    $this->get('/administracion/productos/crear')->assertOk();

    $attributes = [
      'title' => $this->faker->sentence,
      'description' => $this->faker->paragraph,
      'price' => 20.35,
      'published' => 0,
      'stock' => rand(0,3000),
      'validate_stock' => rand(0,1),
      'selling_type' => rand(1,2),
      'category_id' => factory('App\Category')->create()->id,
      'brand_id' => factory('App\Brand')->create()->id,
      'uploads' => factory('App\Upload',5)->create()->pluck('id'),
    ];

    $this->post('/administracion/productos', $attributes);

    unset($attributes['uploads']);

    $product = Product::where($attributes)->first();

    $this->assertInstanceOf('App\Product', $product);

    $this->assertCount(5, $product->uploads->toArray());

    $this->assertEquals($this->slug($attributes['title'], Product::class), $product->slug);

  }

  /** @test **/
  public function a_user_can_update_a_product()
  {
    $this->signIn();
    $product = factory('App\Product')->create();

    $this->get("{$product->path()}/editar")->assertOk();

    $attributes = [
      'title' => 'Changed Title',
      'description' => 'Changed Description',
      'price' => 20.35,
      'published' => 1,
      'stock' => rand(0,3000),
      'validate_stock' => rand(0,1),
      'selling_type' => rand(1,2),
      'category_id' => factory('App\Category')->create()->id,
      'brand_id' => factory('App\Brand')->create()->id,
      'uploads' => factory('App\Upload',5)->create()->pluck('id'),
    ];

    $this->put($product->path(), $attributes)->assertRedirect("{$product->path()}/editar");

    unset($attributes['uploads']);

    $this->assertDatabaseHas('products', $attributes);
  }

  /** @test **/
  public function a_user_can_delete_a_product()
  {
    $this->signIn();
    $product = factory('App\Product')->create();

    $this->delete($product->path())->assertRedirect('/administracion/productos');

    $this->assertDatabaseMissing('products', ['id' => $product->id]);
  }

  /** @test **/
  public function a_product_requires_a_valid_title()
  {
    $this->signIn();

    $attributes = factory('App\Product')->raw(['title' => '']);

    $this->post('/administracion/productos', $attributes)->assertSessionHasErrors('title');

    $attributes['title'] = $this->faker->sentence(100);

    $this->post('/administracion/productos', $attributes)->assertSessionHasErrors('title');
  }

  /** @test **/
  public function a_product_requires_a_description()
  {
    $this->signIn();

    $attributes = factory('App\Product')->raw(['description' => '']);

    $this->post('/administracion/productos', $attributes)->assertSessionHasErrors('description');
  }

  /** @test **/
  public function a_product_requires_a_valid_price()
  {
    $this->signIn();

    $attributes = factory('App\Product')->raw(['price' => '']);

    $this->post('/administracion/productos', $attributes)->assertSessionHasErrors('price');

    $attributes['price'] = -1;
    $this->post('/administracion/productos', $attributes)->assertSessionHasErrors('price');

    $attributes['price'] = 0;
    $this->post('/administracion/productos', $attributes)->assertSessionHasErrors('price');

  }

  /** @test **/
  public function a_product_requires_a_valid_stock()
  {
    $this->signIn();

    $attributes = factory('App\Product')->raw(['stock' => -1]);

    $this->post('/administracion/productos', $attributes)->assertSessionHasErrors('stock');
  }

  /** @test **/
  public function a_product_requires_a_valid_selling_type()
  {
    $this->signIn();

    $attributes = factory('App\Product')->raw(['selling_type' => 3]);

    $this->post('/administracion/productos', $attributes)->assertSessionHasErrors('selling_type');
  }

  /** @test **/
  public function a_product_requires_a_valid_category()
  {
    $this->signIn();

    $attributes = factory('App\Product')->raw(['category_id' => '']);

    $this->post('/administracion/productos', $attributes)->assertSessionHasErrors('category_id');

    $attributes['category_id'] = 5;

    $this->post('/administracion/productos', $attributes)->assertSessionHasErrors('category_id');
  }

  /** @test **/
  public function a_product_requires_a_valid_brand()
  {
    $this->signIn();

    $attributes = factory('App\Product')->raw(['brand_id' => null]);

    $this->post('/administracion/productos', $attributes)->assertSessionHasNoErrors();

    $attributes['brand_id'] = 5;

    $this->post('/administracion/productos', $attributes)->assertSessionHasErrors('brand_id');
  }
}
