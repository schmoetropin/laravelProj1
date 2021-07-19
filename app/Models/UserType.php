<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $table='userTypes';
    protected $pimaryKey='id';

    public function user(){
        return $this->hasMany(User::class);
    }
}
