<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $connection = 'new_user';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($employee) {
            $employee->emp_no= 'EMP' . str_pad(self::count() + 1, 4, '0', STR_PAD_LEFT);
        });
    }
}
