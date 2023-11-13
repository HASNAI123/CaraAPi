<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acknowledgment extends Model
{
    use HasFactory;
    protected $table = 'Acknowledgement';

    protected $fillable = [
        'User_id',
        'user_name',
        'Terms_1',
        'Terms_2',
        'Date_Downloaded',
        'Type'
    ];


}
