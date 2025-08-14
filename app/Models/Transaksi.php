<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi'; 
    protected $fillable = [
        'jenis_simpanan_id',
        'id_simpanan',
        'setoran',
        'tgl',
    ];

    public function simpanan()
    {
        return $this->belongsTo(Simpanan::class, 'id_simpanan', 'id');
    }

    public function jenisSimpanan(){
        return $this->belongsTo(Jenis_simpanan::class, 'jenis_simpanan_id', 'id');
    }   
}