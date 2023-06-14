@extends('layouts.admin')

@section('content')
<h1>Ticket List</h1>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<a href="{{ route('ticket.create') }}" class="btn btn-primary mb-3" target="_blank">Tambah tiket</a>
<table class="table table-bordered table-striped" id="example1" >
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Token</th>
        <th>Action</th>
    </thead>
    @foreach($tickets as $ticket)
    <tbody>
        <td>{{ $ticket->id }}</td>
        <td>{{ $ticket->name }}</td>
        <td>{{ $ticket->email }}</td>
        <td>{{ $ticket->phone }}</td>
        <td>{{ $ticket->token }}</td>
        <td>
            <div class="btn-group">
                <a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-primary ">Edit</a>
                <form action="{{ route('ticket.destroy', $ticket->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger ml-2">Delete</button>
                </form>
            </div>
        </td>
    </tbody>
    @endforeach
</table>
@endsection