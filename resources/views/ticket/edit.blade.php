@extends('layouts.admin')

@section('content')
<h1>Edit Ticket</h1>
<div class="col-md-6">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('ticket.update', $ticket->id) }}" method="post">
                @csrf
                @method('POST')
                <div class="forn-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="{{ $ticket->name }}" class="form-control" required>
                    <div class="invalid-feedback">
                        Please enter your name.
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="{{ $ticket->email }}" class="form-control" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" value="{{ $ticket->phone }}" class="form-control" required>
                    <div class="invalid-feedback">
                        Please enter your phone number.
                    </div>
                </div>

                <input type="hidden" name="token" value="{{ uniqid() }}" required>
                <button type="submit">Update Ticket</button>
            </form>
        </div>
    </div>
</div>

@endsection