<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetGallery extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'gallery_pet_name', 'gallery_pet_image', 'pet_id'
    ];
    protected $primaryKey = 'gallery_pet_id';
    protected $table = 'tbl_gallery_pet';
}
