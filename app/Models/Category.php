<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    // public function product()
    // {
    //     return $this->hasMany('App\Models\Product', 'category_id');
    // }
    public function product()
    {
        return $this->hasOne('App\Models\Product', 'category_id');
    }
}
