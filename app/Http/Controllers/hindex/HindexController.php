<?php

namespace App\Http\Controllers\hindex;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HindexController extends Controller
{
    //首页代码
    public function hindex()
    {
      return view('hindex/hindex');
    }
}
