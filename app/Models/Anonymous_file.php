<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anonymous_file extends Model
{
    use HasFactory;
    protected $fillable = [
        'hashcode',
        'name',   
        'qrcode',
        'description'
    ];
}
