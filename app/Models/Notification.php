<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'text',
        'dispatch_at',
        'sent',
    ];

    public function scopeActive($query)
    {
        $query->where('dispatch_at', '<=', now())
            ->where('sent',0);
    }
}
