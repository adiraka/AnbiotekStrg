<?php

namespace Anbiotek\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getBeranda()
    {
    	return view('front.home');
    } 

    public function getProduk()
    {
    	return view('front.produk');
    }

    public function getTentang()
    {
    	return view('front.tentang');
    }
}
