@extends('layouts.guest')

@section('content')


@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="col-md-6 mx-auto">
        <h1>Concert Ticket Booking</h1>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Order Tiket</h3>
            </div>
            <form action="{{ route('ticket.store') }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter your name.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter your phone number.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Book Ticket</button>
                    <input type="hidden" name="token" value="{{ uniqid() }}" required>
                </div>


            </form>
        </div>
    </div>
</div>

@endsection