<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadquartersCompany extends Model
{
    use HasFactory;
    protected $table = 'headquarters_company';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'company_id',
        'name',
        'address',
        'phone',
        'email',
        'created_by'
    ];
}
