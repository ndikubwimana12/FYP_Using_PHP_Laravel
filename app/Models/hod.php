<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Hod extends Authenticatable
{
    protected $table = 'hod';
    protected $primaryKey = 'Hod_id';

    protected $fillable = [
        'Hod_id',
        'FirstName',
        'LastName',
        'Gender',
        'Email',
        'PhoneNumber',
        'password',
        'DepartmentCode',
        'user_id'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'DepartmentCode', 'DepartmentCode');
    }
}
