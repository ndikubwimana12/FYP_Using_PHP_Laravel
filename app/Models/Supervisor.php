<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    protected $table = 'supervisor';

    protected $primaryKey = 'SupervisorEmail'; // Assuming SupervisorEmail is the primary key
    public $incrementing = false; // Since it's an email, it's not an integer
    protected $keyType = 'string';

    protected $fillable = [
        'SupervisorEmail',
        'SupervisorFirstName',
        'SupervisorLastName',
        'SupervisorPhoneNumber',
        'DepartmentCode',
        'user_id'
    ];
    public function department()
    {
        return $this->belongsTo(Department::class, 'DepartmentCode', 'DepartmentCode');
    }
    public function projects()
    {
        return $this->hasMany(Project::class, 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'id');
    }
    public function supervisions()
    {
        return $this->hasMany(Supervision::class, 'supervisor_id', 'id');
    }
}
