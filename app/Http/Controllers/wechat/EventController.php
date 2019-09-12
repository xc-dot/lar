<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * 接收微信发送的消息【用户互动】
     */
    public function event()
    {
        echo '111';
    }
}
