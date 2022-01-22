@extends('layout.app')

@section('content')
    <h1>Contacts</h1>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="d-flex">

        <a href="{{ route('contacts.create') }}" class="btn btn-success" style="margin-right: 20px">Add</a>

        <a href="{{ route('contacts.archive') }}" class="btn btn-secondary">Archive</a>

        <form action="{{ route('contacts.index') }}" method="GET" class="d-flex ml-5">
            {{ csrf_field() }}
            <input type="text" name="search" class="form-control" placeholder="Enter contact name">
            <button type="submit" class="btn btn-secondary ml-3">Search</button>
        </form>

    </div>

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
                <td><a href="{{ route('contacts.edit', ['contact' => $contact->id]) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('contacts.delete', ['contact' => $contact->id]) }}"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $contacts->links() }}
@endsection
