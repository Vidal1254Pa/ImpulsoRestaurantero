<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
        'created_by',
    ];
    protected $hidden = ['pivot'];
}
