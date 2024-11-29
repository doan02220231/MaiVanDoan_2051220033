<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CombDetails extends Model
{
    public $timestamps = false;
    protected $fillable = ['combo_details_name','order_code_combo', 'combo_details_gia'];
    protected $primaryKey = 'combo_details_id';
    protected $table = 'tbl_combo_details';
}
