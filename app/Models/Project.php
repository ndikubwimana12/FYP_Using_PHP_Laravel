<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project'; // Define the table name

    protected $fillable = [
        'ProjectCode',
        'ProjectName',
        'ProjectProblems',
        'ProjectSolutions',
        'ProjectAbstract',
        'ProjectDissertation',
        'ProjectSourceCodes',
        'StudentRegNumber',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentRegNumber', 'StudentRegNumber');
    }
    public function supervision()
{
    return $this->belongsTo(Supervision::class, 'StudentRegNumber', 'StudentRegNumber');
}
public function supervisor()
{
    return $this->hasOneThrough(
        Supervisor::class,
        Supervision::class,
        'StudentRegNumber', // Foreign key on supervisions table
        'id', // Foreign key on supervisors table
        'StudentRegNumber', // Local key on projects table
        'supervisor_id' // Local key on supervisions table
    );
}



}
