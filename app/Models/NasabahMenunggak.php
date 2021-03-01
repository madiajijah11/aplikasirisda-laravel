<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahMenunggak extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nohp',
        'alamat',
        'norekening',
        'pinjaman',
        'tgljatuhtempo',
        'jumlahmenunggak'
    ];
}
