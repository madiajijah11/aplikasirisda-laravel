<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahLunas extends Model
{
  use HasFactory;

  protected $fillable = [
    'nama',
    'nohp',
    'alamat',
    'norekening',
    'pinjaman',
    'jangkawaktu',
    'status'
  ];
}
