<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    'status',
    'created_by',
    'updated_by'
  ];

  protected static function boot()
  {
    parent::boot();
    static::creating(function ($model) {
      $model->created_by = Auth::id();
      $model->update_by = Auth::id();
    });
    static::updating(function ($model) {
      $model->update_by = Auth::id();
    });
  }
}
