<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // الحقول القابلة للتعبئة
    protected $fillable = [
        'name',
        'description',
        'created_by',
        'type_id',
        'user_id'
    ];

    // علاقة: الفئة تتبع مستخدم
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // علاقة: الفئة تتبع نوع فئة
    public function type()
    {
        return $this->belongsTo(CategoryType::class, 'type_id');
    }
}