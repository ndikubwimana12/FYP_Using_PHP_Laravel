<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compus extends Model
{
    protected $table = 'Campus';
    protected $primaryKey = 'CampusId';

    protected $fillable = [
        'CampusId',
        'CampusName',
    ];

}
