<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table= 'products';
    protected $fillable = [
        'productName',
        'productCategory',
        
        'productModel',
        
       
        'productQuantity',
        'productPrice',
        'productDescription',
        'productImage',
        'companyEmail',
       


    ];

}
