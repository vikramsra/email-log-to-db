<?php

namespace Vikramsra\EmailLogToDb\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vikramsra\EmailLogToDb\EmailLog;

class EmailLogController extends Controller
{
    public function index(Request $request)
{
    // Start with a query builder
    $query = EmailLog::query();

    // Apply filters if present
    if ($request->filled('recipient')) {
        $query->where('recipient', 'like', '%' . $request->recipient . '%');
    }

    if ($request->filled('subject')) {
        $query->where('subject', 'like', '%' . $request->subject . '%');
    }

    if ($request->filled('sent_date')) {
        $query->whereDate('created_at', $request->sent_date);
    }

    // Get paginated results with applied filters
    $logs = $query->paginate(10);

    if ($request->ajax()) {
        return view('emailLogs::partials.email_logs_table', compact('logs'))->render();
    }

    return view('emailLogs::index', compact('logs'));
}
}
