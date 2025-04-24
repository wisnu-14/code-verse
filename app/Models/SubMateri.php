<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMateri extends Model
{
    use HasFactory;
    protected $table = 'sub_materi';

    protected $fillable = ['materi_id', 'sub_judul', 'penjelasan','kode','penjelasan_kode','foto'];

    // Relasi ke materi
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
