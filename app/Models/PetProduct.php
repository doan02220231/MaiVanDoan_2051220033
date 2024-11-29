<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetProduct extends Model
{
   public $timestamps = false; //set time to false
    protected $fillable = [
        'pet_name', 'pet_type','pet_age','pet_gender','pet_slug','rental_price_per_day','pet_image',
        'pet_content','pet_desc','pet_status'
    ];
    protected $primaryKey = 'pet_id';
    protected $table = 'tbl_pet';
   
}
