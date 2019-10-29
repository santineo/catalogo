<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signIn($user = null)
    {
      $user = $user ?: factory('App\User')->create();
       $this->actingAs($user);
       return $user;
    }

    protected function slug($sluggable, $class)
    {
      return SlugService::createSlug($class, 'slug', $sluggable, ['unique' => false]);
    }

    protected function getImage()
    {
      Storage::fake('avatars');
      return UploadedFile::fake()->image('avatar.jpg');
    }
}
