<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanLayanan extends Model
{
    use HasFactory;

    protected $guarded = ['pengajuan_id'];
    
    protected $primaryKey = 'pengajuan_id';
    public $incrementing = false;

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function dataKematian(){
        return $this->hasMany(DataKematian::class, 'pengajuan_id');
    }

    public function dataKelahiran(){
        return $this->hasMany(DataKelahiran::class, 'pengajuan_id');
    }
}
