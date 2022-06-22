<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierSecurity extends Model
{
    use HasFactory;

    protected $fillable = ['courier_id', 'question_id', 'department_id', 'department_security_id', 'status'];
}
