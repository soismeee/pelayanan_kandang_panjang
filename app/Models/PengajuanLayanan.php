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
}
