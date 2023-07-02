<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
	protected $primaryKey = 'id_member';

	public function penjualan(){
      return $this->hasMany('App\Penjualan', 'id_supplier');
    }
}
