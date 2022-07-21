<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInformation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table= 'companyinfo';
    protected $fillable = [
        
        'Headquarters',
        'numOfWorkers',
        'Phone',
        'Industry',
        'Website',
        'Description',
        'photo',
        'CompanyId'

    ];
    // CompanyEmail	Headquarters	numOfWorkers	Phone	Industry	Website	Description	photo	






}
