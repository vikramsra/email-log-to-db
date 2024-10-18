@section('content')
<div class="container mt-5">
    <h2>Email Log Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Sender:</strong> {{ $log->sender }}</p>
            <p><strong>Recipient:</strong> {{ $log->recipient }}</p>
            <p><strong>CC:</strong> {{ $log->cc }}</p>
            <p><strong>BCC:</strong> {{ $log->bcc }}</p>
            <p><strong>Subject:</strong> {{ $log->subject }}</p>
            <p><strong>Body:</strong> {!! nl2br(e($log->body)) !!}</p>
            <p><strong>Sent At:</strong> {{ $log->created_at->format('Y-m-d H:i:s') }}</p>
            <p><strong>Attachments:</strong></p>
            @if(is_array($log->attachments) && count($log->attachments) > 0)
                <ul>
                    @foreach($log->attachments as $attachment)
                        <li><a href="{{ $attachment['path'] }}" target="_blank">{{ $attachment['filename'] }}</a></li>
                    @endforeach
                </ul>
            @else
                <p>No Attachments</p>
            @endif
        </div>
    </div>
    <a href="{{ route('email.logs.index') }}" class="btn btn-secondary mt-3">Back to Email Logs</a>
</div>
@endsection
