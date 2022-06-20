<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['name','user_id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    // public function scopeDernier(Builder $query){
    //     return $query->orderBy("updated_at","desc");
    // }
    public static function boot(){
        parent::boot();
        static::addGlobalScope(new LatestScope);
    }
}
