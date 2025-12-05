<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatUser extends Model
{
    use HasFactory;

    protected $table = 't_alamat_user';

    protected $fillable = [
        'user_id',
        'nama',
        'telepon',
        'alamat',
        'kota',
        'kode_pos',
        'negara',
        'provinsi',
        'utama',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}