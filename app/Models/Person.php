<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function tasks()
    {
        return $this->morphMany(Task::class, 'taskable');
    }
}