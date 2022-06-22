<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image', 'serial_number', 'department_id',  'file_name', 'status', 'user_id'
    ];

    public function getImageAttribute($value){
        return Storage::url("images/".$value);
    }
    public function user(){
        return $this->belongsTo('App\Model\User', 'user_id');
    }

    public function department() {
        return $this->belongsTo('App\Model\department', 'department_id');
    }
}
