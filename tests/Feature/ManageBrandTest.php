<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Brand;

class ManageBrandTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  /** @test **/
  public function guest_cannot_manage_brands()
  {
    $brand = factory('App\Brand')->create();
    $this->get('/administracion/marcas')->assertRedirect('login');
    $this->get('/administracion/marcas/crear')->assertRedirect('login');
    $this->get("{$brand->path()}/editar")->assertRedirect('login');
    $this->post('/administracion/marcas')->assertRedirect('login');
    $this->put($brand->path())->assertRedirect('login');
    $this->delete($brand->path())->assertRedirect('login');
  }

  /** @test **/
  public function a_user_can_show_the_brands()
  {
    $this->signIn();

    $brand = factory('App\Brand')->create();

    $this->get('/administracion/marcas')->assertOk();
    $this->get($brand->path())->assertOk();
  }

  /** @test **/
  public function a_user_can_create_a_brand()
  {
    $this->signIn();
    $this->get('/administracion/marcas/crear')->assertOk();

    $this->post('/administracion/marcas', $attributes = ['name' => $this->faker->sentence])->assertRedirect('/administracion/marcas');
    $brand = Brand::where($attributes)->first();

    $this->assertEquals($this->slug($attributes['name'], Brand::class), $brand->slug);
  }

  /** @test **/
  public function a_user_can_update_a_brand()
  {
    $this->signIn();
    $brand = factory('App\Brand')->create();

    $this->get("{$brand->path()}/editar")->assertOk();

    $this->put($brand->path(), $attributes = ['name' => 'New Name'])->assertRedirect('/administracion/marcas');

    $this->assertDatabaseHas('brands', $attributes);
  }

  /** @test **/
  public function a_user_can_delete_a_brand()
  {
    $this->signIn();
    $brand = factory('App\Brand')->create();

    $this->delete($brand->path())->assertRedirect('/administracion/marcas');
    $this->assertDatabaseMissing('brands', ['id' => $brand->id]);
  }

  /** @test **/
  public function a_brand_requires_a_name()
  {
    $this->signIn();
    $brand = factory('App\Brand')->create();

    $this->post('/administracion/marcas', [])->assertSessionHasErrors('name');
    $this->put($brand->path(), [])->assertSessionHasErrors('name');
  }

  /** @test **/
  public function a_user_cannot_delete_a_brand_if_has_products()
  {
    $this->signIn();
    $brand = factory('App\Brand')->create();
    $brand->products()->createMany(
      factory('App\Product', 1)->raw(['brand_id' => null])
    );

    $this->delete($brand->path())->assertRedirect('/administracion/marcas')->assertSessionHasErrors('product_assigned');
  }
}
