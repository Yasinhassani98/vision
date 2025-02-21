<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'level_id', 'type', 'description', 'start_time', 'end_time'];

    public function level(){
        return $this->belongsTo(Level::class);
    }
}
