<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Brand;

class BrandTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  /** @test **/
  public function brand_has_a_path()
  {
    $brand = factory('App\Brand')->create();
    $this->assertEquals("/administracion/marcas/{$brand->id}", $brand->path());
  }

  /** @test **/
  public function brand_has_trait_buttons()
  {
    $brand = factory('App\Brand')->create();
    $this->hasTraitButton($brand);
  }

  /** @test **/
  public function brand_has_many_products()
  {
    $brand = factory('App\Brand')->create();
    $brand->products()->createMany(
      factory('App\Product', 3)->make(['brand_id' => null])->toArray()
    );

    $this->assertCount(3, $brand->products->toArray());
  }

  /** @test **/
  public function brand_has_a_count_of_his_products()
  {
    $brand = factory('App\Brand')->create();
    $brand->products()->createMany(
      factory('App\Product', 3)->make(['brand_id' => null])->toArray()
    );

    $this->assertEquals(3, $brand->products_count);
  }

  /** @test **/
  public function can_find_terms()
  {
    factory('App\Brand')->create(['name' => 'Lorem ipsum dolo brand']);
    factory('App\Brand')->create(['name' => 'A diferent brand']);
    factory('App\Brand')->create(['name' => 'Another diferent brand']);

    $this->assertCount(1, Brand::search('ipsum')->get());
    $this->assertCount(2, Brand::search('diferent')->get());
    $this->assertCount(3, Brand::search('brand')->get());
    $this->assertCount(3, Brand::search(false)->get());
  }
}
