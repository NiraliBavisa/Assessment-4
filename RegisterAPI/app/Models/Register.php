<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $fillable=[
        'name',
        'email',
        'password',
    'c_password'];
}
