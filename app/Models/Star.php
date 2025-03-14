<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Star extends Model
{
    use HasFactory;

    protected $casts = [
        'is_vpn_ip' => 'boolean',
    ];

    /**
     * Описание со стороны модели к артиклям и плагинам
     * @return MorphTo
     */
    public function starrable(): MorphTo
    {
        return $this->morphTo(); //Описание полиморфной связи
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getConnectionName()
    {
        return config('database.default');
    }
}
