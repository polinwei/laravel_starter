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
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="userName" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="userName" value="{{ $user->name }}">
                    </div>
                    <div class="col-md-4">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" value="{{ $user->email }}">
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>



    </section>
@endsection
