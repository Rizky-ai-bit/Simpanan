<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Simpanan extends Model
{
    use HasFactory;

    protected $table = 'simpanan';
    protected $fillable = [
        'nama',
        'nomor_anggota',
        'unit',
        'unit',
        'no_hp'
    ];

     public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_simpanan', 'id');
    }
}