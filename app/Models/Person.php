<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'business',
        'tags',
    ];
    
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function tasks()
    {
        return $this->morphMany(Task::class, 'taskable');
    }
}