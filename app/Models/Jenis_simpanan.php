<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Jenis_simpanan extends Model
{
    use HasFactory;
    protected $table = 'jenis_simpanan';
    protected $fillable = [
        'jenis'
    ];
}
