
@extends('layouts.auth.verification')

@section('content')
<br>
    <div class="bg-light p-5 rounded text-center">
        <h4>Account Verification</h4>
        
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                A fresh verification link has been sent to your email address.
            </div>
        @endif

        Before proceeding, please check your email for a verification link. If you did not receive the email,
        <br>
        <form action="" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-primary">
                click here to request another
            </button>
        </form>
    </div>
@endsection