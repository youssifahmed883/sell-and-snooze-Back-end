<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table= 'messages';
    protected $fillable = [
        'messageFrom',
        'messageTo',
        'messageContent',
        'ReciverPhoto'


    ];
}
