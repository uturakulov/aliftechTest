@extends('layout.app')

@section('content')
    <h1>Contact Details</h1>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <a href="{{ route('details.create') }}" class="btn btn-success" style="margin-right: 20px">Add</a>

    <a href="{{ route('details.archive') }}" class="btn btn-secondary">Archive</a>

    <table class="table text-center">
        <tr>
            <th>ID</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>
        @foreach ($details as $detail)
            <tr>
                <td>{{ $detail->id }}</td>
                <td>{{ $detail->phone }}</td>
                <td>{{ $detail->email }}</td>
                <td>{{ $detail->contacts->name ?? 'NA' }}</td>
                <td><a href="{{ route('details.edit', ['detail' => $detail->id]) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('details.delete', ['detail' => $detail->id]) }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $details->links() }}
@endsection
