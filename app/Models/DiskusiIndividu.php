<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiskusiIndividu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'diskusi_individu';

    protected $fillable = [
        'siswa_id',
        'siswa_sender_id',
        'siswa_receiver_id',
        'komentar',
    ];

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }
}
