<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = ['grade_level'];
    public function students(){
        return $this->hasMany(Student::class);
    }
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'level_teacher', 'level_id', 'teacher_id');
    }

    public function schedules(){
        return $this->hasMany(Schedule::class);
    }

}
