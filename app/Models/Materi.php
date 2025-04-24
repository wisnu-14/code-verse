<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materi';
    protected $fillable = ['judul', 'deskripsi','cover','kategori_id','views'];

    // Relasi ke sub_materi
    public function subMateri()
    {
        return $this->hasMany(SubMateri::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id'); // pastikan 'kategori_id' sesuai dengan kolom di database
    }



}
