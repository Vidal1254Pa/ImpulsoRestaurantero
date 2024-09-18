<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsPlan extends Model
{
    use HasFactory;
    protected $table = 'products_plans';
    protected $primaryKey = null;
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'plan_id',
        'user_id',
    ];
}
