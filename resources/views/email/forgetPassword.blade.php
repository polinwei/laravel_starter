@extends('layouts.auth.index')
@section('content')

<h1>Forget Password Email</h1>
   
You can reset password from bellow link:
<a href="{{ route('reset.password.get', [$email,$token]) }}">Reset Password</a>

@endsection