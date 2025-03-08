<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', // Ajoutez ce champ
        'title',
        'description',
        'location',
        'salary',
        'company_name',
        'company_website',
    ];
}