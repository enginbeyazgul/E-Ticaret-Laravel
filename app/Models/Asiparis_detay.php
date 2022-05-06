<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asiparis_detay extends Model
{
    use HasFactory;
    protected $table = "Asiparis_detay";
    protected $fillable=["siparis_no","urun_kodu","adet"];
    public $timestamps=false;
    public function urunAd(){
        return $this->hasOne(Aurun::class,"urun_kodu","urun_kodu");
    }
}
