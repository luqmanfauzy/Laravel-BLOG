<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory; 
    use Sluggable;

    protected $table = 'posts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title', 'slug', 'categories_id', 'users_id', 'excerpt', 'body', 'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }   
    
    
}


