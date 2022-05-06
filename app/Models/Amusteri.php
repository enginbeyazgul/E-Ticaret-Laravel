<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amusteri extends Model
{
    use HasFactory;
    protected $table = "Amusteri";
    protected $primaryKey = 'musteri_no';
    protected $fillable=["musteri_no","ad","soyad","mail","sifre","telefon","adres","durum"];
    public $timestamps=false;
    public function sepet(){
        return $this->hasMany(Asepet::class,"musteri_no","musteri_no");
    }
}
