<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerjadinForm extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'nomor_surat',
        'tanggal_surat',
        'tanggal_berangkat',
        'tanggal_pulang',
        'nama_kegiatan',
        'jenis_kegiatan',
        'surat_kegiatan',
        'nama_instansi',
        'alamat_kegiatan',
        'pengikut',
        'status',
        'catatan_admin',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'tanggal_berangkat' => 'date',
        'tanggal_pulang' => 'date',
        'pengikut' => 'array',
    ];

    /**
     * Get the user that owns the perjadian form.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
