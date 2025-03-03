<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objeto extends Model
{
    use HasFactory;

    protected $table = "Objeto";
    public $timestamps = false;
    protected $fillable = [
        "id",
        "nombre",
        "precio",
        "categoria",
        "imagenes"
    ];
}
