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
                <h5 class="card-title">編輯用戶</h5>
                {{ html()->modelForm($user,'PATCH')->class('row g-3')->route('users.update', $user->id)->open() }}
                    <div class="col-md-4">
                        <label for="userEmail" class="form-label">Email</label>
                        {{ html()->email('email') }}
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label">Your Name</label>
                        {{ html()->text('name') }}
                    </div>
                    <div class="col-md-4">
                        <label for="username" class="form-label">Your Name</label>
                        {{ html()->text('username') }}
                    </div>

                    <div class="col-12">
                        <label for="Roles" class="form-label">Roles</label>
                        {{ html()->multiselect('roles[]', $roles, $userRole)->class('form-control') }}
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                {{ html()->closeModelForm() }}
            </div>
        </div>



    </section>
@endsection
