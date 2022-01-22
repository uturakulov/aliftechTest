@extends('layout.app')

@section('content')
    <h1>Archived Contacts</h1>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    @if ($details->count() < 1)
        <h2 class="text-center">No archived data</h2>
    @else
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
                    <td><a href="{{ route('details.restore', ['detail' => $detail->id]) }}"
                            class="btn btn-primary">Restore</a>
                        <a href="{{ route('details.destroy', ['detail' => $detail->id]) }}"
                            class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $details->links() }}
    @endif

@endsection
