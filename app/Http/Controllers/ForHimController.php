<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForHimController extends Controller
{
    public function index()
    {
        return view('layout.for-him.index');
    }
}
