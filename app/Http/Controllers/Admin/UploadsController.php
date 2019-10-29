<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Upload;
use Illuminate\Http\Request;

class UploadsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
      // Borrar los uploads que no se suban finalmente al producto --- ¡¡ Importante !!
      $r = request()->validate(['image' => 'required|max:2048|image']);
      $upload = new Upload();
      $upload->storeImage($r['image']);
      $upload->save();

      return response()->json(['image' => $upload], 200);
    }

}
