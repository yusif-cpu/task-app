<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Task extends Model
{
    protected $fillable = [
        'title',
        'completed',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOwnedBy($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
    public function scopeTaskBy($query, $taskId, $userId)
    {
        return $query
        ->where('id', $taskId)
        ->where('user_id', $userId);
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value),
            get: fn ($value) => ucwords($value),
        );
    }
    protected function titleDb(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => trim($value)
        );
    }
}
