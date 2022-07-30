<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;

    protected $table = 'stok_barang';

    protected $primaryKey = 'id_stok';

    protected $guarded = ['id_stok'];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }
}
