<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemarkSA extends Model
{
    use HasFactory;
    protected $table = 'SAchecklist';

    protected $fillable = [
        'remark_data',
    ];

    protected $casts = [
        'remark_data' => 'json',
    ];
}
