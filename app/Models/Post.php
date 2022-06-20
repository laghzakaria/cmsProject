<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=['title','description','content','category_id','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    //un post a plusieur commentaire
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    //relation polymorphic avec le tableau images
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
    public static function boot(){
        parent::boot();
        //vider le cache de show si l'utilisateur modifie le post
        static::updating(function(Post $post){
            Cache::forget("post-show-{$post->id}");
        });
    }
}
