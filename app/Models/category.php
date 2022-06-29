<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'category'
    ];

    function subCategory(){
        return $this->hasMany('App\Models\sub_category');
    }
}
