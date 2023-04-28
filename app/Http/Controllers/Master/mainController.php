<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class mainController extends Controller
{
    public function homePage()
    {
        return view('master.home');
    }
}
