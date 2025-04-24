<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'deskripsi','cover','kategori_id','views'];

    // Relasi dengan kategori
    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'kategori_id');
    }

    // Relasi dengan subTutorials (jika ada)
    public function subTutorials()
    {
        return $this->hasMany(SubTutorial::class, 'tutorial_id');
    }
}
