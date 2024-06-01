<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property int $submission_status_id
 * @property string $title
 * @property string $note
 * @property string $shopping_note
 * @property string $created_at
 * @property string $updated_at
 */

class Submission extends Model
{
    use HasFactory;
    protected $fillable=['user_id', 'submission_status_id', 'title', 'note','shopping_note'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function submissionStatus(): BelongsTo
    {
        return $this->belongsTo(SubmissionStatus::class,'submission_status_id');
    }

    public function submissionDetails(): HasMany
    {
        return $this->hasMany(SubmissionDetail::class,'submission_id');
    }

}
