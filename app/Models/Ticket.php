<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'is_checked_in'];

    // Mendefinisikan kolom 'is_checked_in' sebagai tipe boolean
    protected $casts = [
        'is_checked_in' => 'boolean',
    ];
}
