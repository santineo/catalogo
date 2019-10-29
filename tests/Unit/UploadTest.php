<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UploadTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  // Agregar Test cuando para eliminar los uploads

  /** @test **/
  public function upload_has_setted_urls()
  {
    $upload = factory('App\Upload')->create();

    $this->assertEquals($upload->url, $upload->doUrl());
    $this->assertEquals($upload->thumb, $upload->doUrl('thumb'));
    $this->assertEquals($upload->small, $upload->doUrl('small'));
  }
}
