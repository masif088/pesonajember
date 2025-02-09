<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int order_id
 * @property string title
 * @property string mockup_file
 */
class OrderMockup extends Model
{
    use HasFactory;

    protected $fillable=['order_id', 'title', 'mockup_file'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
