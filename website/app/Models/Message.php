<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'chatRoomId', // Thêm 'chatRoomId' vào 'fillable' property
        'user_id',
        'content',
        'type',
        'parent_id',
    ];
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'chatRoomId', 'id');
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function notifications() :HasMany
    {
        return $this->hasMany(Notification::class, 'message_id', 'id');
    }
}
