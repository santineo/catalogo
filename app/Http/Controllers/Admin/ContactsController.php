<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Contact Info
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        if(!request()->ajax()) abort(404);
        return response()->json(['view' => view('admin.contacts.show', compact('contact'))->render()], 200);
    }
}
