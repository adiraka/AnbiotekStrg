<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use Anbiotek\Http\Requests;

class AdminController extends Controller
{
    public function getHome()
    {
        return view('home.index');
    }
}
