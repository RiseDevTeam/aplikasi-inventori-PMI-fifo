<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    use HasFactory;

    protected $table = 'detail_user';

    protected $primaryKey = 'id_detail_user';
    protected $guarded = ['id_detail_user'];

    public $timestamps = false;
}
