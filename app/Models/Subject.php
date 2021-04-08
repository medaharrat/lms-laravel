<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'code';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'credits',
    ];

    public function task(){
        return $this->hasMany('App\Task');
    }

    /*public function user(){
        return $this->belongsToMany(User::class)->addWhereConstraints('is_teacher', '=', 1);
        return $this->belongsTo(User::class)->addWhereConstraints('is_teacher', '=', 0);
    }*/
}
