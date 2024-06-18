<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CooperativeCreditEmployeePay extends Model
{
    protected $table='cooperative_credit_employee_details';
    use HasFactory;

    protected $fillable = ['title', 'date_transaction', 'debit', 'credit', 'cooperative_credit_employee_id'];
    public function cooperativeCreditEmployee(): BelongsTo
    {
        return $this->belongsTo(CooperativeCreditEmployee::class, 'cooperative_credit_employee_id');
    }
}
