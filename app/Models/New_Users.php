<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class New_Users extends Model
{
    use HasFactory;
    protected $table = 'new__users'; 
    protected $fillable = [
        'username',
        'role',
        'email',
        'password_hash'
    ];
    protected $hidden = [
        'password_hash'
    ];
}
