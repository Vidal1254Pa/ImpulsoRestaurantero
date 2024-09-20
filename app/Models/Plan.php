<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $table = 'plans';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;


    protected $fillable = [
        'name',
        'description',
        'price',
        'created_by',
    ];

    protected $hidden = ['pivot'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_plans', 'plan_id', 'product_id');
    }
}
