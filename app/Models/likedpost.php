<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class likedpost extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table= 'likedposts';
    protected $fillable = [
        'postid',
        'useremail',

    ];

}
