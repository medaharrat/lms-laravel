<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'subject_id',
        'description',
        'points',
    ];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function solutions() {
        return $this->hasMany(Solution::class);
    }
}
