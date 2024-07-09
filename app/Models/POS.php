<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POS extends Model
{
    use HasFactory;
    protected $connection = 'new_user';
    
    public static function generatePOS()
    {   
        $posNo= 'PO' . str_pad(self::count() + 1, 4, '0', STR_PAD_LEFT);
        return $posNo;
    }
    
    public function customer()
    {
    	return $this->hasOne(Customer::class, 'id' , 'customer_id');
    }


    
}
