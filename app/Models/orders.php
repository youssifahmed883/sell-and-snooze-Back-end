<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table= 'orders';
    protected $fillable = [
        'userPhoto',
        'username',
        'productName',
        'productModel',
        'quantity',
        'productPhoto',
        'productId',
        'companyEmail',
        'status'


    ];
}
