<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestMateri extends Model
{
    use HasFactory;
    protected $table = 'requests';

    protected $fillable = [
        'name',
        'email',
        'title',
        'message',
    ];
}
