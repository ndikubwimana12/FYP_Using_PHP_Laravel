<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table = 'Student';
    protected $primaryKey = 'StudentRegNumber';
    public $incrementing = false;

    protected $fillable = [
        'StudentRegNumber',
        'StudentFirstName',
        'StudentLastName',
        'StudentGender',
        'StudentEmail',
        'StudentPhoneNumber',
        'password',
        'DepartmentCode',
        'user_id'
    ];

    public function project()
    {
        return $this->hasOne(Project::class, 'StudentRegNumber', 'StudentRegNumber');
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }
    public function supervision()
    {
        return $this->hasOne(Supervision::class, 'StudentRegNumber', 'StudentRegNumber');
    }
    // Validate StudentRegNumber before saving
    public static function isValidRegNumber($regNumber)
    {
        return !(strpos($regNumber, 'RP') === false || $regNumber == "0");
    }
}
