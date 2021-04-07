<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts=[
        'is_active' => 'boolean'
    ];

    /**
     * @return BelongsTo
     */
    public function bio(): BelongsTo
    {
        return $this->belongsTo(Bio::class);
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(LinkType::class);
    }

    public function svg(): BelongsTo
    {
        return $this->belongsTo(Svg::class);
    }
}
