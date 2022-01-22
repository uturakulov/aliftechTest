@extends('layout.app')

@section('content')
    <h1>Archived Contacts</h1>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    @if ($contacts->count() < 1)
        <h2 class="text-center">No archived data</h2>
    @else
        <table class="table text-center">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>
                        @foreach ($contact->phoneMail as $details)
                            {{ $details->phone }}
                            <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($contact->phoneMail as $details)
                            {{ $details->email }}
                            <br>
                        @endforeach
                    </td>
                    <td><a href="{{ route('contacts.restore', ['contact' => $contact->id]) }}"
                            class="btn btn-primary">Restore</a>
                        <a href="{{ route('contacts.destroy', ['contact' => $contact->id]) }}"
                            class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $contacts->links() }}
    @endif
@endsection
