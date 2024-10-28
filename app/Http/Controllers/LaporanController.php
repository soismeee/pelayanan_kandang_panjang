<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function indexKelahiran(){
        return view('laporan.kelahiran', [
            'title' => 'Laporan kelahiran',
            'menu' => 'laporan',
            'submenu' => 'kelahiran',
        ]);
    }

    public function indexKematian(){
        return view('laporan.kematian', [
            'title' => 'Laporan kematian',
            'menu' => 'laporan',
            'submenu' => 'kematian',
        ]);
    }
}
