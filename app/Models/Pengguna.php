<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $guarded = ['pengguna_id'];
    
    protected $primaryKey = 'pengguna_id';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
