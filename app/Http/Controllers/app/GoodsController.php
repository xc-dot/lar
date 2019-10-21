<?php

namespace App\Http\Controllers\app;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function news()
    {
        return json_encode(['ret'=>1,'data'=>'xxx']);
    }
}
