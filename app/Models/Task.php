<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'points',
    ];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

    public function solution() {
        return $this->hasMany(Solution::class);
    }
}
