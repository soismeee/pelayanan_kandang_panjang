<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelahiran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pengajuanPelayanan(){
        return $this->belongsTo(PengajuanLayanan::class, 'pengajuan_id');
    }
}
