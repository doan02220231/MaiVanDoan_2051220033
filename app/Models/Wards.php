<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timestamps = false;
    protected $fillable = ['name_xp','type','maqh',];
    protected $primaKey = 'xaid';
    protected $table = 'tbl_xaphuongthitran';
}
