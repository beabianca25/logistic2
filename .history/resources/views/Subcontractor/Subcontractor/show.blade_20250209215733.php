<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subcontractor Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1,
        h2 {
            text-align: center;
            color: #333;
        }

        h2 {
            margin-top: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }

        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .info {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .list-group {
            list-style: none;
            padding: 0;
        }

        .list-group-item {
            background: #fff;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .button-container {
            display: flex;
            justify-content: flex-start;
            margin-top: 20px;
        }

        .btn-back,
        .btn-edit {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back {
            background-color: #6c757d;
            margin-right: 10px;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .btn-edit:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Subcontractor Details</h1>

        <!-- Subcontractor Information -->
        <div class="info">
            <p><strong>Name:</strong> {{ $subcontractor->subcontractor_name }}</p>
            <p><strong>Business Registration Number:</strong> {{ $subcontractor->business_registration_number }}</p>
            <p><strong>Contact Person:</strong> {{ $subcontractor->contact_person }}</p>
            <p><strong>Business Address:</strong> {{ $subcontractor->business_address }}</p>
            <p><strong>Phone:</strong> {{ $subcontractor->phone }}</p>
            <p><strong>Email:</strong> {{ $subcontractor->email }}</p>
            <p><strong>Website:</strong> <a href="{{ $subcontractor->website }}"
                    target="_blank">{{ $subcontractor->website }}</a></p>
            <p><strong>Services Offered:</strong> {{ $subcontractor->services_offered }}</p>
            <p><strong>Relevant Experience:</strong> {{ $subcontractor->relevant_experience }}</p>
        </div>

        <!-- Requirements Section -->
        <h2>Requirements</h2>
        @if ($subcontractor->requirements->isNotEmpty())
            <ul class="list-group">
                @foreach ($subcontractor->requirements as $requirement)
                    <li class="list-group-item">
                        {{ $requirement->requirement_name }} - {{ $requirement->status }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>No requirements available.</p>
        @endif

    </div> <!-- Attachments Section -->
    <h2>Attachments</h2>
    @if ($subcontractor->attachments->isNotEmpty())
        <ul class="list-group">
            @foreach ($subcontractor->attachments as $attachment)
                <li class="list-group-item">
                    <a href="{{ asset('storage/' . $attachment->file_path) }}"
                        target="_blank">{{ $attachment->file_name }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No attachments available.</p>
    @endif


    <!-- Back and Edit Buttons -->
    <div class="button-container">
        <a href="{{ route('subcontractor.index') }}" class="btn-back">Back</a>
        <a href="{{ route('subcontractor.edit', $subcontractor->id) }}" class="btn-edit">Edit</a>
    </div>

</body>

</html>
