<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $table      = "solutions";
    public    $primaryKey = "id";
    public    $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'task_id',
        'evaluatedOn',
        'points',
    ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
