<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping_thue extends Model
{
    public $timestamps = false;
    protected $fillable = ['shipping_thue_name','shipping_thue_address','shipping_thue_phone','shipping_thue_email','shipping_thue_nodes','shipping_thue_method'];
    protected $primaryKey = 'shipping_thue_id';
    protected $table = 'tbl_shipping_thue';
  
}
