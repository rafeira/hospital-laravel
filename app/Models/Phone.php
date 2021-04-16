<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;


    protected $fillable = [
        'ddd',
        'ddi',
        'number',
    ];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }
}
