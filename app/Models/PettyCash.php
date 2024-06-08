<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $date_transaction
 * @property int $debit
 * @property int $credit
 * @property string $created_at
 * @property string $updated_at
 */
class PettyCash extends Model
{
    use HasFactory;
    protected $fillable=['date_transaction', 'debit', 'credit','title'];

}
