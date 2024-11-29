<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
   public $timestamps = false; //set time to false
    protected $fillable = [
         'combo_image','combo_name','combo_gia','combo_content'
    ];
    protected $primaryKey = 'combo_id';
    protected $table = 'tbl_pet_combo';
}
