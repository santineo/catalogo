<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// use App\Product;

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

}
