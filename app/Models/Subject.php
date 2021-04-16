<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'credits',
    ];

    public function task(){
        return $this->hasMany(Task::class);
    }

    public function teachers() {
        return $this->belongsTo(User::class);
    }

    public function students() {
        return $this->belongsToMany(User::class, 'students_subjects', 'subject_id', 'student_id');
    }
}
