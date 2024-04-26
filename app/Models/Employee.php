<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'age',
        'role',
        'active',
        'sector_id',
    ];

    /**
     * Get the sector that the employee belongs to.
     */
    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    /**
     * Get the skills associated with the employee.
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'employee_skills');
    }
}
