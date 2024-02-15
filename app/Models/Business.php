<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'email',
        'categories',
        'tags',
    ];
    
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