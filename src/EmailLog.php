<?php

namespace Vikramsra\EmailLogToDb;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $table = 'email_logs';

    protected $fillable = [
        'sender',
        'recipient',
        'cc',
        'bcc',
        'subject',
        'body',
        'headers',
        'attachments',
    ];

    protected $casts = [
        'attachments' => 'array', // Attachments will be stored as a JSON array
    ];
}
