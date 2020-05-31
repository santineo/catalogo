<?php

namespace App\Http\Controllers\Admin;

use App\Config;
use App\Upload;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.configs.index', ['configs' => Config::all()]);
    }

    /**
     * Update the resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function save()
    {
        request()->validate([
          'configs.*.index' => 'required',
        ]);

        foreach (request('configs') as $key => $config) {
          $configModel = Config::firstOrCreate(['index' => $config['index']]);
          $configModel->value = isset($config['value']) ? $config['value'] : null;
          if(isset($config['upload_id']) && $upload = Upload::find($config['upload_id'])) {
            $configModel->uploads()->delete();
            $configModel->uploads()->save($upload);
          }
          $configModel->save();
        }

        return response()->json([], 200);
    }

}
