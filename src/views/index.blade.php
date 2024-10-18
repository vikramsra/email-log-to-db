<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Logs</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-body pre {
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Email Logs</h2>

        <!-- Filter Form -->
        <form id="filter-form" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" id="recipient" name="recipient" class="form-control" placeholder="Recipient" value="{{ request('recipient') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" value="{{ request('subject') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" id="sent_date" name="sent_date" class="form-control" value="{{ request('sent_date') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('email.logs.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <div id="email-logs-container" class="table-responsive">
            @include('emailLogs::partials.email_logs_table', ['logs' => $logs])
        </div>
    </div>

    <!-- Modal for Viewing Email Details -->
    <div class="modal fade" id="logDetailModal" tabindex="-1" aria-labelledby="logDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logDetailModalLabel">Email Log Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Sender:</strong> <span id="log-sender"></span></p>
                    <p><strong>Recipient:</strong> <span id="log-recipient"></span></p>
                    <p><strong>CC:</strong> <span id="log-cc"></span></p>
                    <p><strong>BCC:</strong> <span id="log-bcc"></span></p>
                    <p><strong>Subject:</strong> <span id="log-subject"></span></p>
                    <p><strong>Body:</strong></p>
                    <pre id="log-body"></pre>
                    <p><strong>Attachments:</strong></p>
                    <div id="log-attachments"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript to handle real-time search -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchLogs() {
                let recipient = $('#recipient').val();
                let subject = $('#subject').val();
                let sent_date = $('#sent_date').val();

                $.ajax({
                    url: "{{ route('email.logs.index') }}",
                    method: "GET",
                    data: {
                        recipient: recipient,
                        subject: subject,
                        sent_date: sent_date,
                    },
                    success: function(data) {
                        $('#email-logs-container').html(data);
                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                });
            }

            // Attach keyup events to the recipient and subject input fields
            $('#recipient, #subject').on('keyup', function() {
                fetchLogs();
            });

            // Attach change event to the sent_date input field
            $('#sent_date').on('change', function() {
                fetchLogs();
            });
        });

        // JavaScript to handle the modal data population
        const logDetailModal = document.getElementById('logDetailModal');
        logDetailModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            // Extract data from the button attributes
            const sender = button.getAttribute('data-sender');
            const recipient = button.getAttribute('data-recipient');
            const cc = button.getAttribute('data-cc') || 'N/A';
            const bcc = button.getAttribute('data-bcc') || 'N/A';
            const subject = button.getAttribute('data-subject');
            const body = button.getAttribute('data-body');
            const attachments = JSON.parse(button.getAttribute('data-attachments'));

            // Update the modal content
            document.getElementById('log-sender').textContent = sender;
            document.getElementById('log-recipient').textContent = recipient;
            document.getElementById('log-cc').textContent = cc;
            document.getElementById('log-bcc').textContent = bcc;
            document.getElementById('log-subject').textContent = subject;
            document.getElementById('log-body').textContent = body;

            // Handle attachments
            const attachmentsContainer = document.getElementById('log-attachments');
            attachmentsContainer.innerHTML = '';
            if (attachments && attachments.length > 0) {
                attachments.forEach(function(attachment) {
                    const link = document.createElement('a');
                    link.href = attachment.path;
                    link.target = '_blank';
                    link.textContent = 'Download ' + attachment.filename;
                    attachmentsContainer.appendChild(link);
                    attachmentsContainer.appendChild(document.createElement('br'));
                });
            } else {
                attachmentsContainer.textContent = 'No Attachments';
            }
        });
    </script>
</body>
</html>
