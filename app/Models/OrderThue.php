<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderThue extends Model
{
    public $timestamps = false;
    protected $fillable = ['order_code_thue', 'pet_id', 'pet_name', 'pet_slug', 'pet_price', 'pet_qty', 'pet_coupon'];

    protected $primaryKey = 'order_details_thue_id';
    protected $table = 'tbl_order_details_thue';
    public function petproduct(){
        return $this->belongsTo('App\Models\PetProduct','pet_id');
    }
}
