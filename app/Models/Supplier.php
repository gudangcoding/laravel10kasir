<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
   protected $table = 'suppliers';
   protected $primaryKey = 'id_supplier';

   public function pembelian(){
      return $this->hasMany('App\Pembelian', 'id_supplier');
   }
}
