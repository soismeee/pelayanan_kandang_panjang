<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashbaordController extends Controller
{
    public function index(){
        return view('home.index', [
            'title' => 'Dashboard',
        ]);
    }
}
