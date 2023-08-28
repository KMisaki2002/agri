<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'user_id',
        'body',
        'image'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
    
    public function isLikedBy($user): bool{
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
    
}