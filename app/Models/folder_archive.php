<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class folder_archive extends Model
{
    use HasFactory;

    protected $fillable = ['title','password','created_by','Division','Document_Category','priority'];
    protected $table = 'archive_folders';



}
