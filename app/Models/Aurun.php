<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aurun extends Model
{
    use HasFactory;
    protected $table = "Aurun";
    protected $primaryKey = 'urun_kodu';
    protected $fillable=["urun_kodu","kategori_kodu","stok","fiyat","ad","aciklama","resim1","resim2"];
    public $timestamps=false;
}
