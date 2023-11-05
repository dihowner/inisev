<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribedUserNotify extends Model
{
    use HasFactory;
    protected $fillable = ['subscriber_id', 'website_id', 'post_id', 'status'];

    public function user() {
        return $this->belongsTo(User::class, 'subscriber_id', 'id');
    }
    
    public function post() {
        return $this->belongsTo(Posts::class, 'post_id', 'id');
    }
    
    public function website() {
        return $this->belongsTo(Websites::class, 'website_id', 'id');
    }
}
