<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    /**
     * Table associated with the model.
     */
    protected $table = 'visitors';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'ip_address',
    ];

    /**
     * Relationships (Optional).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
