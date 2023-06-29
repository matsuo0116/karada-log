<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';
    
    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'log_types')->withPivot('weight')->withPivot('count')->withPivot('sets');
    }
    public function exercises(){
        return $this->hasMany(Exercise::class);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    protected $attributes = [
        'comment' => '',
        'weight' => '0',
        'fat_per' => '0'
    ];

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
