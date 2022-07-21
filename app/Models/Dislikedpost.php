<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dislikedpost extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table= 'dislikedposts';
    protected $fillable = [
        'postid',
        'useremail',

    ];

}
