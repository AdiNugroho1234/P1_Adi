<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart'; // atau 'carts' jika nama tabel jamak

    protected $fillable = [
        'user_id',
        'barang_id',
        'nama_barang',
        'jenis_barang',
        'harga',
        'quantity',
        'photo',
        'ukuran',
    ];
}
