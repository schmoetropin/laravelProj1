<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user','topic','type'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function topic(){
        return $this->belongsTo(Topic::class);
    }
}
