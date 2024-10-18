<table class="table table-hover table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Sender</th>
            <th>Recipient</th>
            <th>Subject</th>
            <th>Sent At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($logs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->sender }}</td>
                <td>{{ $log->recipient }}</td>
                <td>{{ $log->subject }}</td>
                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#logDetailModal" 
                        data-id="{{ $log->id }}"
                        data-sender="{{ $log->sender }}"
                        data-recipient="{{ $log->recipient }}"
                        data-subject="{{ $log->subject }}"
                        data-body="{{ e($log->body) }}"
                        data-cc="{{ $log->cc }}"
                        data-bcc="{{ $log->bcc }}"
                        data-attachments="{{ json_encode($log->attachments) }}">
                        View Details
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No email logs available.</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $logs->appends(request()->query())->links() }}
</div>
