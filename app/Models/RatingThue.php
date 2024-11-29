<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingThue extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'rating_thue_id', 'rating_code_id', 'rating_thue','week'
    ];
    protected $primaryKey = 'rating_thue_id';
    protected $table = 'tbl_rating_thue';
}
