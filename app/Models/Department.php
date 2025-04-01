<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'Department';
    protected $primaryKey = 'DepartmentCode';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'DepartmentCode',
        'DepartmentName',
        'CampusId'
    ];

    
}
