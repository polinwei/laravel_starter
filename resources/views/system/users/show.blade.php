@extends('layouts.NiceAdmin.index')
@section('pageContent')
    {{ Breadcrumbs::render('users.index') }}

    <section class="section">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back </a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">用戶資訊</h5>
                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="userName" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="userName" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="email_verified_at" class="form-label">Email Verified At</label>
                        <input type="email" class="form-control" id="email_verified_at"
                            value="{{ $user->email_verified_at }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="created_at" class="form-label">Created At</label>
                        <input type="email" class="form-control" id="created_at"
                            value="{{ $user->created_at }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="updated_at" class="form-label">Updated At</label>
                        <input type="email" class="form-control" id="updated_at"
                            value="{{ $user->updated_at }}" readonly>
                    </div>
                    <div class="col-12">
                        <label for="Roles" class="form-label">Roles</label>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <label class="badge bg-primary">{{ $v }}</label>
                            @endforeach
                        @endif
                    </div>
                    <div class="text-center">
                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                    </div>
                </form>
            </div>
        </div>



    </section>
@endsection
