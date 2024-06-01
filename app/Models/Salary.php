<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property int $basic_salary
 * @property int $bonus
 * @property int $overtime
 * @property int $transportation
 * @property int $debt_deduction
 * @property int $employee_cooperative_deductions
 * @property string $reference
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 */
//$table->unsignedBigInteger('user_id');
//$table->decimal('basic_salary');
//$table->decimal('bonus');
//$table->decimal('overtime');
//$table->decimal('transportation');
//$table->decimal('debt_deduction');
//$table->decimal('employee_cooperative_deductions');
//$table->string('reference');
//$table->text('note');

class Salary extends Model
{
    use HasFactory;
    protected $fillable=['user_id', 'basic_salary', 'bonus', 'overtime', 'transportation', 'debt_deduction', 'employee_cooperative_deductions', 'reference','note'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
