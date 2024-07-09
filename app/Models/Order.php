<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $connection = 'new_user';
   // Generate a daily order number
   public static function generateOrderNumber()
   {
       $prefix = 'ORD-' . now()->format('dmY'); // Prefix with 'ORD-' and current date
       $latestOrder = self::where('order_no', 'like', $prefix . '%')->latest()->first();

       if (!$latestOrder) {
           $number = 1;
       } else {
           $number = intval(substr($latestOrder->order_no, -3)) + 1; // Extract number part and increment
       }

       $newOrderNumber = $prefix . '-' . str_pad($number, 3, '0', STR_PAD_LEFT); // Format the number part

       return $newOrderNumber;
   }

   public function table()
   {
       return $this->hasOne(Table::class, 'id' , 'table_no');
   }
   public function orderDetails()
   {
       return $this->hasMany(OrderDetails::class, 'order_id' , 'id');
   }
   public function pos()
    {
        return $this->hasOne(POS::class, 'order_id' , 'id');
    }
   
}
