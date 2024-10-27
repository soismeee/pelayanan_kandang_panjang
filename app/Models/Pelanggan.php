<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $guarded = ['pelanggan_id'];
    
    protected $primaryKey = 'pelanggan_id';
    public $incrementing = false;
}
