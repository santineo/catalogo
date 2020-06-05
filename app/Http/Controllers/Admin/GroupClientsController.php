<?php

namespace App\Http\Controllers\Admin;

use App\GroupClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupClients = GroupClient::search(request('term'));
        if(request('limited')) $groupClients->has('clients');
        $groupClients = $groupClients->get();
        if(request()->ajax()) return response()->json(['list' => $groupClients], 200);
        return view('admin.group_clients.index', compact('groupClients'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.group_clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $groupClient = GroupClient::create($this->validateRequest());

        return redirect()->route('grupos.index')->with(['info' => "Se ha creado el grupo <strong>$groupClient->name</strong>"]);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupClient  $groupClient
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupClient $groupClient)
    {
        return view('admin.group_clients.edit', compact('groupClient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupClient  $groupClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupClient $groupClient)
    {
      $groupClient->fill($this->validateRequest())->save();

      return redirect()->route('grupos.index')->with(['info' => "Se ha actualizado el cliente <strong>$groupClient->name</strong>"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupClient  $groupClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupClient $groupClient)
    {
      $groupClient->delete();

      return redirect()->route('grupos.index')->with(['info' => "Se ha eliminado el cliente <strong>$groupClient->name</strong>"]);
    }

    /**
     * Validate Request Data of Client
     *
     * @return array
     */
    private function validateRequest()
    {
      return request()->validate([
        'name' => 'required' . (request()->get('id') ? ('|' . request()->get('id') - '|id') : ''),
      ]);
    }
}
