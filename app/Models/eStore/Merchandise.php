<?php

namespace App\Models\eStore;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
    ];
}
