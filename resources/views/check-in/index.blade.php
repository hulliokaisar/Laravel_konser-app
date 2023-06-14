@extends('layouts.guest')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="card card-primary col-md-6">
        <div class="card-header text-center">
            <h3 class="card-title text-center">Check In Ticket</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('check-in.verify') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="token">Ticket Token:</label>
                    <input type="text" name="token" id="token" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Verify</button>
            </form>
        </div>
    </div>
</div>

@endsection