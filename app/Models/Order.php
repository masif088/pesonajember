<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int transaction_type_id
 * @property int customer_id
 * @property int user_id
 * @property string order_number
 */
class Order extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_type_id', 'customer_id', 'user_id', 'order_number'];

    public function transactionType(){
        return $this->belongsTo(TransactionType::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orderProducts(){
        return $this->hasMany(OrderProduct::class);
    }
}
