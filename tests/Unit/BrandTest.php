<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
  public function brand_has_many_products()
  {
    $brand = factory('App\Brand')->create();
    $brand->products()->createMany(
        factory('App\Product', 3)->make(['brand_id' => null])->toArray()
      );

    $this->assertCount(3, $brand->products->toArray());
  }
}
