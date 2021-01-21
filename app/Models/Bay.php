<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bay extends Model
{
    use HasFactory;

    protected $table = 'bays';
    public $timestamps = true;

    protected $fillable = ['number', 'bay_status_id'];
}
