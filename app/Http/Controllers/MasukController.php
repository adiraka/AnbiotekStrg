<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

use Anbiotek\Http\Requests;

class MasukController extends Controller
{
    public function getMasuk()
    {
      return view('masuk.add');
    }

    public function addMasuk(Request $request)
    {
        dd($request->all());
    }
}
