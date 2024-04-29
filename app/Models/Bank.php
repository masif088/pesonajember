<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $bank_name
 * @property string $account_in_name
 * @property string $note
 * @property int $status_id
 * @property string $created_at
 * @property string $updated_at
 * @property Status $status
 */
class Bank extends Model
{
    use HasFactory;

    protected $fillable = ['bank_name', 'account_in_name', 'note', 'status_id'];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
