<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status', 'user_id'];

    public function courier(){
        return $this->hasMany('App\Model\Courier', 'courier_id', 'id');
    }
}

