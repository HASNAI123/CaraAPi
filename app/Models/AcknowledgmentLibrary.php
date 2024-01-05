<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcknowledgmentLibrary extends Model
{
    use HasFactory;
    protected $table = 'AcknowledgmentLibrary';

    protected $fillable = [
        'User_id',
        'user_name',
        'Terms_1',
        'Terms_2',
        'Date_Downloaded',
        'Type'
    ];


}
