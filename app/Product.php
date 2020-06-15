<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function type()
    {
    	return $this->belongsTo('App\ProductType', 'type_id');
    }

    public function bills()
   	{
   		return $this->hasMany('App\BillDetail', 'product_id', 'id');
   	}
}
