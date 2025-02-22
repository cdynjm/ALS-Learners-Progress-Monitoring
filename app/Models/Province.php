<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'province';

    protected $fillable = [
       'psgcCode',
       'provDesc',
       'regCode',
       'provCode'
    ];
}
