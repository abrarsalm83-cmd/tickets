<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address';
    protected $fillable = [
        'user_id',
        'country',
        'city',
        'street',
        'postal_code',
        'details'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}