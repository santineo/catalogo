<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Category;

class ManageCategoryTest extends TestCase
{
  use WithFaker, RefreshDatabase;

  /** @test **/
  public function guest_cannot_manage_categories()
  {
    $category = factory('App\Category')->create();

    $this->get('/administracion/categorias')->assertRedirect('login');
    $this->get('/administracion/categorias/crear')->assertRedirect('login');
    $this->get($category->path())->assertRedirect('login');
    $this->get("{$category->path()}/editar")->assertRedirect('login');
    $this->post('/administracion/categorias', $category->toArray())->assertRedirect('login');
    $this->put($category->path())->assertRedirect('login');
    $this->delete($category->path())->assertRedirect('login');
  }

  /** @test **/
  public function a_user_can_show_the_categories()
  {
    $this->signIn();
    $category = factory('App\Category')->create();

    $this->get('/administracion/categorias')->assertOk();
    $this->get($category->path())->assertOk();
  }

  /** @test **/
  public function a_user_can_create_a_category()
  {
    $this->signIn();

    $this->get('/administracion/categorias/crear')->assertOk();

    $attributes = [
      'name' => $this->faker->sentence
    ];

    $response = $this->post('/administracion/categorias', $attributes);
    $category = Category::where($attributes)->first();

    $this->assertEquals($this->slug($attributes['name'], Category::class), $category->slug);

    $response->assertRedirect('/administracion/categorias');
  }

  /** @test **/
  public function a_user_can_update_a_category()
  {
    $this->signIn();
    $category = factory('App\Category')->create();

    $this->get("{$category->path()}/editar")->assertOk();

    $this->put($category->path(), ['name' => 'Changed'])->assertRedirect('/administracion/categorias');

    $this->assertDatabaseHas('categories', ['name' => 'Changed', 'slug' => $category->slug]);
  }

  /** @test **/
  public function a_user_can_delete_a_category()
  {
    $this->signIn();
    $category = factory('App\Category')->create();

    $this->delete($category->path())->assertRedirect('/administracion/categorias');
    $this->assertDatabaseMissing('categories', ['id' => $category->id]);
  }

  /** @test **/
  public function a_category_requires_a_name()
  {
    $this->signIn();
    $category = factory('App\Category')->create();

    $this->post('/administracion/categorias', [])->assertSessionHasErrors('name');
    $this->put($category->path(), [])->assertSessionHasErrors('name');
  }

}
