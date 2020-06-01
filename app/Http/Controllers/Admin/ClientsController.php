<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::search(request()->get('term'))->get();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $client = Client::create($this->validateRequest());

        return redirect()->route('clientes.index')->with(['info' => "Se ha creado el cliente <strong>$client->name</strong>"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
      if(!request()->ajax()) abort(404);
      return response()->json(['view' => view('admin.clients.show', compact('client'))->render()], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Client $client)
    {
      $client->fill($this->validateRequest())->save();

      return redirect()->route('clientes.index')->with(['info' => "Se ha actualizado el cliente <strong>$client->name</strong>"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('clientes.index')->with(['info' => "Se ha eliminado el cliente <strong>$client->name</strong>"]);
    }

    /**
     * Validate Request Data of Client
     *
     * @return array
     */
    private function validateRequest()
    {
      return request()->validate([
        'name' => 'required',
        'email' => 'required|email' . (request()->get('id') ? ('|' . request()->get('id') - '|id') : ''),
        'phone' => 'sometimes',
        'information' => 'sometimes'
      ]);
    }
}
