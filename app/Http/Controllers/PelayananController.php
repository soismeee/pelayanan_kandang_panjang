<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelayananController extends Controller
{
    // master kelahiran
    public function index_lhr(){
        return view('pengajuan.kelahiran.index', [
            'title' => 'Data kelahiran',
            'menu' => 'kelahiran',
            'menu' => 'Data kelahiran',
        ]);
    }
    public function create_lhr(){
        return view('pengajuan.kelahiran.create', [
            'title' => 'Input kelahiran',
            'menu' => 'kelahiran',
            'menu' => 'Form kelahiran',
        ]);
    }
}
