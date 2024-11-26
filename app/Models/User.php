<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function studentsAsParent(){
        return $this->hasMany(Student::class,'parent_id','id');
    }
    public function studentsAsTeacher()
    {
        return $this->belongsToMany(Student::class, 'student_teacher', 'teacher_id', 'student_id');
    }
    public function studentsAsSupervisor()
    {
        return $this->hasMany(Student::class, 'supervisor_id', 'id');
    }


    public function gpstrackings(){
        return $this->hasMany(Gpstracking::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
        
    }

    public function payments(){
        return $this->hasMany(Payment::class,'parent_id','id');
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'level_teacher', 'teacher_id', 'level_id');
    }

    
}
