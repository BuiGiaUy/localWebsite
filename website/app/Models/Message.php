<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    public function room()
    {
        return $this->belongsTo(Room::class, 'chatRoomId', 'id');
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
