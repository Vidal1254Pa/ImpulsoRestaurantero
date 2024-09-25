<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProductsCompany extends Model
{
    use HasFactory;

    protected $table = 'category_products_company';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'headquarters_company_id',
        'name',
        'description',
        'created_by',
    ];
}
