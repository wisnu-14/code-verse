<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTutorial extends Model
{
    use HasFactory;

    protected $fillable = ['materi_id','tutorial_id', 'sub_judul', 'penjelasan','kode','penjelasan_kode','foto'];

    // Relasi ke materi
    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }
}
