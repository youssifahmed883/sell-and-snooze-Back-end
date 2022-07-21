<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commentModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table= 'comments';
    protected $fillable = [
        
        'postId',
        'username',
        'userPhoto',
        'commentContent',
        

    ];
}
