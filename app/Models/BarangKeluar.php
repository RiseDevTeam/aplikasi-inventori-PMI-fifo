<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';

    protected $primaryKey = 'id_barang_keluar';
    protected $guarded = ['id_barang_keluar'];

    public $timestamps = false;
}
