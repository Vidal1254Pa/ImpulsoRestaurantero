<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryUnitMesure extends Model
{
    use HasFactory;

    protected $table = 'category_unit_mesure';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'created_by',
    ];
}
