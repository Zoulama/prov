<?php

namespace LeadAssurance\\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'oders';
    protected $fillable = ['user_id','last_name','email','password'];
}
