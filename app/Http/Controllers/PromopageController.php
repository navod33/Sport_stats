<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromopageController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.promo_page')->render();
    }
}
