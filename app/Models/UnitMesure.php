<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitMesure extends Model
{
    use HasFactory;
    protected $table = 'unit_mesure';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'description',
        'category_unit_mesure_id',
        'created_by'
    ];
}
