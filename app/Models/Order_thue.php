<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_thue extends Model
{
    public $timestamps = false;
    protected $fillable = ['shipping_thue_id','customer_id','order_thue_status' ,'order_thue_suc_khoe','order_thue_code'
    ,'order_thue_date'];
    protected $primaryKey = 'order_thue_id';
    protected $table = 'tbl_order_thue';
}
   