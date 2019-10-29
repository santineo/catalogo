<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Return view of Dashboard
     *
     * @return view
     */
    public function dashboard()
    {
      return view('admin.dashboard');
    }

}
