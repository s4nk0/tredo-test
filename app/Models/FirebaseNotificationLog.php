<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirebaseNotificationLog extends Model
{
    protected $fillable = [
        'user_id',
        'request_body',
        'status_code',
        'sent',
        'response_body',
    ];

    protected $casts = [
        'request_body'=>'array',
        'response_body'=>'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
