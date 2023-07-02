<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
   protected $table = 'produks';
   protected $primaryKey = 'id_produk';
   
   public function kategori(){
      return $this->belongsTo('App\Kategori');
   }
}
