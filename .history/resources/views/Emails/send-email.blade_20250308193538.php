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
                                <a href="#" class="suggestion-link">Booking Confirmation</a>
                            </li>
                            <li class="list-group-item suggested-message" data-subject="Application Received" data-message="We have received your application and it is under review.">
                                <a href="#" class="suggestion-link">Application Received</a>
                            </li>
                            <li class="list-group-item suggested-message" data-subject="Application Approved" data-message="Your application has been approved. Congratulations!">
                                <a href="#" class="suggestion-link">Application Approved</a>
                            </li>
                            <li class="list-group-item suggested-message" data-subject="Bid Notification" data-message="There is a higher bid than yours. You may want to update your bid.">
                                <a href="#" class="suggestion-link">Bid Notification</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#compose-textarea').summernote();

        $('.suggested-message').on('click', function (e) {
            e.preventDefault(); // Prevent page jump when clicking

            var subject = $(this).data('subject');
            var message = $(this).data('message');

            $('#email-subject').val(subject);
            $('#compose-textarea').summernote('code', message);
        });
    });
</script>
@endsection
