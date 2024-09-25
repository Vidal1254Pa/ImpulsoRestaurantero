<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliersCompany extends Model
{
    use HasFactory;

    protected $table = 'suppliers_company';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'phone',
        'address',
        'created_by'
    ];
}
