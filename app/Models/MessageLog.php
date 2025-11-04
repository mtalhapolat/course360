<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageLog extends Model
{
    use HasFactory;

    protected $table = 'message_logs';
    protected $fillable = ['phone', 'message', 'student_id', 'lesson_id', 'event_id', 'kindergarten_group_id', 'form_id', 'user_id', 'statu', 'created_at', 'updated_at'];
}
