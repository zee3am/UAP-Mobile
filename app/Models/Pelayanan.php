<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    protected $table = 'pelayanans';

    protected $fillable = [
        'nama',
        'jenis',
        'harga',
        'foto_sepatu',
    ];
}
