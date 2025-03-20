@extends('base')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
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
                                <input type="text" name="subject" id="email-subject" class="form-control" value="{{ request('subject') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px" required>{{ request('message') }}</textarea>
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
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('#compose-textarea').summernote();
    });
</script>
@endsection
