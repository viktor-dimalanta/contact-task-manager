<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag_name',
    ];

    public function businesses()
    {
        return $this->morphedByMany(Business::class, 'taggable');
    }

    public function people()
    {
        return $this->morphedByMany(Person::class, 'taggable');
    }
}