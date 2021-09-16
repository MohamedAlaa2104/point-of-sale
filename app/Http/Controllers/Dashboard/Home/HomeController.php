<?php

namespace App\Http\Controllers\Dashboard\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct()
    {
       $this->middleware(['hasAnyPermission']);
    }

    public function index ()
    {
        return view('dashboard.index');
    }

}
