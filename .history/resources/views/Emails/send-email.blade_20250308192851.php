@extends('base')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <a href="#" class="btn btn-primary btn-block mb-3">Back to Inbox</a>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Folders</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-inbox"></i> Inbox
                                    <span class="badge bg-primary float-right">12</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-envelope"></i> Sent
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-file-alt"></i> Drafts
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Compose New Message</h3>
                    </div>
                    <form action="{{ route('email.send') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">Recipient Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter recipient email" required>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject:</label>
                                <input type="text" name="subject" id="email-subject" class="form-control" placeholder="Enter email subject" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="attachment">Attachment:</label>
                                <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Attach File
                                    <input type="file" name="attachment">
                                </div>
                                <p class="help-block">Max. 32MB</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                            </div>
                            <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Suggested Messages</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item suggested-message" data-subject="Booking Confirmation" data-message="Thank you for booking with us. Your reservation has been confirmed.">
                                Booking Confirmation
                            </li>
                            <li class="list-group-item suggested-message" data-subject="Application Received" data-message="We have received your application and it is under review.">
                                Application Received
                            </li>
                            <li class="list-group-item suggested-message" data-subject="Application Approved" data-message="Your application has been approved. Congratulations!">
                                Application Approved
                            </li>
                            <li class="list-group-item suggested-message" data-subject="Bid Notification" data-message="There is a higher bid than yours. You may want to update your bid.">
                                Bid Notification
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function () {
        $('#compose-textarea').summernote();
        
        $('.suggested-message').on('click', function () {
            var subject = $(this).data('subject');
            var message = $(this).data('message');
            $('#email-subject').val(subject);
            $('#compose-textarea').summernote('code', message);
        });
    });
</script>
@endsection
