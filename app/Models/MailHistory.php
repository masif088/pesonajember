<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//$table->string('type_mail')->nullable();
//$table->string('model_type')->nullable();
//$table->string('model_id')->nullable();
//$table->string('mail');
//$table->string('title');
//$table->string('content');

/**
 * @property int id
 * @property string type_mail
 * @property string model_type
 * @property string model_id
 * @property string mail
 * @property string title
 * @property string content
 */
class MailHistory extends Model
{
    use HasFactory;
    protected $fillable=['type_mail', 'model_type', 'model_id', 'mail', 'title', 'content'];
}
