<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaBarang extends Model
{
    use HasFactory;

    protected $table = 'kelola_barang';

    protected $primarykey = 'id_kelola_barang';

    protected $guarded = ['id_kelola_barang'];
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }
}
