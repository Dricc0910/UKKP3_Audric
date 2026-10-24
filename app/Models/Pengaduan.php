<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'nama',
        'no_meja',
        'email',
        'no_hp',
        'lampiran_path',
        'lampiran_nama',
        'masukan',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /** Ringkasan masukan (teks polos) untuk tabel. */
    public function getRingkasanAttribute(): string
    {
        $text = trim(preg_replace('/\s+/u', ' ', (string) $this->masukan));

        return Str::limit($text, 90);
    }
}