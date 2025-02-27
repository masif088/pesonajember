<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int transaction_type_id
 * @property int customer_id
 * @property int user_id
 * @property int status
 * @property string order_number
 * @property double pph
 * @property double ppn
 * @property double percentage
 * @property double value
 * @property string date_end
 */
class Order extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_type_id', 'customer_id', 'user_id', 'order_number','status','pph', 'ppn','percentage', 'value','date_end'];

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
        return $this->hasMany(OrderProduct::class,'order_id');
    }

    public function orderProductOuts(){
        return $this->hasMany(OrderProductOut::class,'order_id');
    }

    public function orderPartners(): HasMany
    {
        return $this->hasMany(OrderPartner::class , 'order_id');
    }

    public function orderSharings(): HasMany
    {
        return $this->hasMany(OrderSharing::class,'order_id');
    }

    public function orderProofOfCashes(): HasMany
    {
        return $this->hasMany(OrderProofOfCash::class,'order_id');
    }
    public function orderInvoices(): HasMany
    {
        return $this->hasMany(OrderInvoice::class,'order_id');
    }
    public function orderMockups(): HasMany
    {
        return $this->hasMany(OrderMockup::class,'order_id');
    }
}
