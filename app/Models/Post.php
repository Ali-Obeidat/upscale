<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded =[];
    // protected $fillable = [
    //     'title',
    //     'post_img',
    //     'body',
    //     'password',
    // ];

    public function user(){
        return $this->belongsTo(User::class);

    }

    public function  getPostImgAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
        }
    // public function  getPostImgAttribute($value) {
    //    asset($value);
    //     }
}
