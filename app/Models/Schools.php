<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schools extends Model
{
    use HasFactory;
    protected $table = 'schools';
    protected $guarded = ['id', 'role'];

    public function schoolAdmin()
    {
        return $this->hasOne(User::class, 'school_id', 'id')->where('role', '2');
    }
}
