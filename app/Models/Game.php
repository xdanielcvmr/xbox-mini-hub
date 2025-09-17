<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Game extends Model 

// Representa os jogos no sistema

{
   public $timestamps = true; 
    protected $fillable = [
        'name', 'studio', 'gender', 'launch', 'cover', 'rate', 'description']; // define os campos que podem ser preenchidos 

        public function reviews() {
            return $this->hasMany(Review::class, 'game_id');
        }

        protected static function booted() {
            static::creating(function ($game) {
            if (!$game->slug && $game->name) {
            $game->slug = \Str::slug($game->name);
        }
        });
}

}
