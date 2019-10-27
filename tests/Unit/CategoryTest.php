<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  /** @test **/
  public function category_has_a_path()
  {
    $category = factory('App\Category')->create();
    $this->assertEquals("/administracion/categorias/{$category->id}", $category->path());
  }

  /** @test **/
  public function category_can_has_related_with_self()
  {
    $parent = factory('App\Category')->create();
    $child = factory('App\Category')->create([
      'name' => 'Parent',
      'parent_id' => $parent->id
    ]);

    $this->assertInstanceOf('App\Category', $child->parent);
    $this->assertTrue($parent->childs->contains($child));
  }

  /** @test **/
  public function slug_cannot_repeat_in_same_parent()
  {
    $parent = factory('App\Category')->create();

    $child1 = factory('App\Category')->create(['name' => 'Same', 'parent_id' => $parent->id]);
    $child2 = factory('App\Category')->create(['name' => 'Same', 'parent_id' => $parent->id]);

    $this->assertNotEquals($child1->slug, $child2->slug);
  }

  /** @test **/
  public function slug_can_repeat_in_different_parent()
  {
    $parent1 = factory('App\Category')->create();
    $parent2 = factory('App\Category')->create();

    $child1 = factory('App\Category')->create(['name' => 'Same', 'parent_id' => $parent1->id]);
    $child2 = factory('App\Category')->create(['name' => 'Same', 'parent_id' => $parent2->id]);

    $this->assertEquals($child1->slug, $child2->slug);
  }

}
