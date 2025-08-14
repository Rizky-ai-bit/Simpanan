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

    public function transaksi(){
        return $this->hasMany(Transaksi::class, 'jenis_simpanan_id', 'id');
    }
}
