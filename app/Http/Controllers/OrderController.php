<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function success()
    {
        return view('order.success');
    }

    public function pending()
    {
        return view('order.pending');
    }
}
