<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSVData extends Model
{
    use HasFactory;

    protected $table = 'csvdata';
    public $timestamps = false;

    protected $fillable = ['name', 'email', 'registration_date'];
}
