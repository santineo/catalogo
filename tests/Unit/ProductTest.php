<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;

class ProductTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  /** @test **/
  public function product_has_a_path()
  {
    $product = factory('App\Product')->create();
    $this->assertEquals("/administracion/productos/{$product->id}", $product->path());
  }

  /** @test **/
  public function product_has_trait_buttons()
  {
    $product = factory('App\Product')->create();
    $this->hasTraitButton($product);
  }

  /** @test **/
  public function can_belongs_to_a_brand()
  {
    $product = factory('App\Product')->create();

    $this->assertInstanceOf('App\Brand', $product->brand);
  }

  /** @test **/
  public function belongs_to_a_category()
  {
    $product = factory('App\Product')->create();

    $this->assertInstanceOf('App\Category', $product->category);
  }

  /** @test **/
  public function has_morph_many_uploads()
  {
    $product = factory('App\Product')->create();
    $upload = factory('App\Upload')->create();

    $product->uploads()->save($upload);

    $this->assertCount(1, $product->uploads->toArray());
  }

  /** @test **/
  public function can_find_terms_by_title()
  {
    factory('App\Product')->create(['title' => 'Lorem ipsum dolo product']);
    factory('App\Product')->create(['title' => 'A diferent product']);
    factory('App\Product')->create(['title' => 'Another diferent product']);

    $this->assertCount(1, Product::search('ipsum')->get());
    $this->assertCount(2, Product::search('diferent')->get());
    $this->assertCount(3, Product::search('product')->get());
    $this->assertCount(3, Product::search(false)->get());
  }

  /** @test **/
  public function can_find_terms_by_id()
  {
    factory('App\Product')->create();

    $this->assertCount(1, Product::search(1)->get());
    $this->assertCount(0, Product::search(2)->get());
  }
}
