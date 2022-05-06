<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asepet extends Model
{
    use HasFactory;
    protected $table = "Asepet";
    protected $fillable=["musteri_no","urun_kodu","adet"];
    public $timestamps=false;
    public function urun(){
        return $this->hasOne(Aurun::class,"urun_kodu","urun_kodu");
    }
}
