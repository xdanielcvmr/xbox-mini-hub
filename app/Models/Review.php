<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'user_id', 'game_id', 'score', 'comment'];

        public function user() {

            return $this->belongsTo(User::class);

        }

        public function game() {
            return $this->belongsTo(Game::class, 'game_id');
        }
}
