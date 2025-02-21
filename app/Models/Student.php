<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','level_id','parent_id','supervisor_id','gender','DOB','bio'];

    public function level(){
        return $this->belongsTo(Level::class);

    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function parent(){
        return $this->belongsTo(User::class,'parent_id','id');
    }
    public function supervisor(){
        return $this->belongsTo(User::class,'supervisor_id','id');
    }
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'student_teacher', 'student_id', 'teacher_id');
    }
    public function grades(){
        return $this->hasMany(Grade::class);

    }
}
