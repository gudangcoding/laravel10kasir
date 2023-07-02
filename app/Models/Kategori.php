<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';
	protected $primaryKey = 'id_kategori';
	
	public function produk(){
		return $this->hasMany('App\Models\Produk', 'id_kategori');
	}
}
