<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aurun_kategori extends Model
{
    use HasFactory;
    protected $table = "Aurun_kategori";
    protected $fillable=["kategori_kodu","ad"];
    public $timestamps=false;
}
