<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Upload;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class ManageUploadTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  /** @test **/
  public function guest_cannot_store_image()
  {
    $this->post('/administracion/uploads')->assertRedirect('login');
  }

  /** @test **/
  public function a_user_can_store_and_delete_upload()
  {
    $this->signIn();
    $image = $this->getImage();
    $response = $this->json('POST', '/administracion/uploads', [
            'image' => $image,
        ]);

    $response->assertOk();

    $upload = Upload::first();

    Storage::assertExists($upload->doPath());

    $upload->delete();

    Storage::assertMissing($upload->doPath());
  }
}
