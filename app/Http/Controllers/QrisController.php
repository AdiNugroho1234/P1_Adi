<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;

class QrisController extends Controller
{
    public function index(): View
    {
        return view('cart.qris'); // nama view tanpa .blade.php
    }
}
