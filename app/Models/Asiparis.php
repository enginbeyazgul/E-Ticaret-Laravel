<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asiparis extends Model
{
    use HasFactory;
    protected $table = "Asiparis";
    protected $fillable=["siparis_no","musteri_no","tarih","durum","teslimat"];
    protected $primaryKey = 'siparis_no';
    public $timestamps=false;
    public function detay(){
        return $this->hasMany(Asiparis_detay::class,"siparis_no","siparis_no");
    }
    public function musteriBilgi(){
        return $this->hasOne(Amusteri::class,"musteri_no","musteri_no");
    }
}
