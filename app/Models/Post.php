<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = false;
    protected $table= 'posts';
    protected $fillable = [
        'Companyusername',
        'description',
        
        'category',
        
       
        'filepath',
        'numOfComment'
       


    ];
}
