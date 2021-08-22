<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class forum extends Model implements Viewable
{
    use HasFactory;
    use InteractsWithViews;
    // use HasPageViewCounter;
    protected $table ='forums';

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

}
