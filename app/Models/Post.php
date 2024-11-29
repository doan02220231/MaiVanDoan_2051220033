<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'post_title', 'post_views', 'post_slug','post_desc', 'post_conten','post_meta_desc','post_meta_keywords','post_status','post_image','category_post_id'
    ];
    protected $primaryKey = 'post_id';
 	protected $table = 'tbl_posts';

    public function cate_post(){
        return $this->belongsTo('App\Models\CatePost','category_post_id');
    }
}
