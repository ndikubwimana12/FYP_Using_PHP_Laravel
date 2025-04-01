<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervision extends Model
{
    protected $table = 'supervisions';
    
    protected $fillable = [
        'supervisor_id',
        'StudentRegNumber',
        'status'
    ];

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentRegNumber', 'StudentRegNumber');
    }

    
    
}
