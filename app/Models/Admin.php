<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected   $table = 'admin';

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
      'email_verified_at' => 'datetime'  
    ];
}
