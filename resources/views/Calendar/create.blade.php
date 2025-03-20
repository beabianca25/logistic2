@extends('base')

@section('head')
    <style>
        form {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 20px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            margin-top: 20px;
            background-color: green;
            color: white;
        }
    </style>
@endsection

@section('content')
    <form action="{{ route('calendar.store') }}" method="POST">
        @csrf
        
        <label for='title'>{{ __('Title') }}</label>
        <input type='text' class='form-control' id='title' name='title' required>

        <label for="start">{{__('Start Date')}}</label>
        <input type='datetime-local' class='form-control' id='start' name='start' required>

        <label for="end">{{__('End Date')}}</label>
        <input type='datetime-local' class='form-control' id='end' name='end' required>

        <label for="backgroundColor">{{__('Background Color')}}</label>
        <input type="color" id="backgroundColor" name="backgroundColor" required />

        <label for="borderColor">{{__('Border Color')}}</label>
        <input type="color" id="borderColor" name="borderColor" required />

        <input type="submit" value="Save" class="btn btn-success" />
    </form>
@endsection