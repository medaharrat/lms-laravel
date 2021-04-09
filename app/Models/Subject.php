<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    
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

    public function teacher() {
        return $this->belongsTo(User::class);
    }

    public function students() {
        return $this->belongsToMany(User::class);
    }
}
