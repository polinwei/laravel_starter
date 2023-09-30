@extends('layouts.NiceAdmin.index')
@section('pageContent')

<div class="container">
    {{ Breadcrumbs::render('errors.403') }}
    <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
    <h1>403</h1>
    <h2>您沒有權限</h2>
    <h2>You do not have permission to access this page</h2>
    <a class="btn" href="{{ route('home') }}">Back to home</a>
    </section>
</div>

@endsection
