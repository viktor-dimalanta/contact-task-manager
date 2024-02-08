<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function tasks()
    {
        return $this->morphMany(Task::class, 'taskable');
    }
}