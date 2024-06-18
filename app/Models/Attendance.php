<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int master_id
 * @property int user_id
 * @property int attendance_status_id
 * @property string entrance_attendance_by_web
 * @property string discharge_attendance_by_web
 * @property string entrance_attendance_by_fingerprint
 * @property string discharge_attendance_by_fingerprint
 * @property string note
 * @property string created_at
 * @property string updated_at
 */
class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['master_id', 'user_id', 'attendance_status_id', 'entrance_attendance_by_web', 'discharge_attendance_by_web', 'entrance_attendance_by_fingerprint', 'discharge_attendance_by_fingerprint', 'note'];

    public function master(): BelongsTo
    {
        return $this->belongsTo(AttendanceMaster::class,'master_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(AttendanceStatus::class,'attendance_status_id');
    }
}
