<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'message',
    ];

    /**
     * Relation avec l'utilisateur (candidat).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec l'offre d'emploi.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}