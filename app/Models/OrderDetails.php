<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $connection = 'new_user';
    public function Product()
   {
       return $this->hasOne(Product::class, 'id' , 'product_id');
   }
}
