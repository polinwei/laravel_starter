@extends('layouts.NiceAdmin.index')
@section('pageContent')
    {{ Breadcrumbs::render('users.create', $user) }}

    <section class="section">
        @include('layouts.common.errorMessage')

        <div class="card">
            <div class="card-header">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back </a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Create New User</h5>
                {{ html()->form('POST')->class('row g-3')->route('users.store')->open() }}
                    <div class="col-md-4">
                        <label for="userEmail" class="form-label">Email(登入系統用)</label>
                        {{ html()->email('email')->class('form-control')->placeholder('e-mail address')->required('email') }}
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label">帳號</label>
                        {{ html()->text('name')->class('form-control')->placeholder('帳號')->required() }}
                    </div>
                    <div class="col-md-4">
                        <label for="username" class="form-label">中文名</label>
                        {{ html()->text('username')->class('form-control')->placeholder('中文名') }}
                    </div>
                    <div class="col-md-4">
                        <label for="password" class="form-label">密碼</label>
                        {{ html()->password('password')->class('form-control')->placeholder('密碼') }}
                    </div>
                    <div class="col-md-4">
                        <label for="password" class="form-label">確認密碼</label>
                        {{ html()->password('confirm-password')->class('form-control')->placeholder('確認密碼') }}
                    </div>
                    <div class="col-12">
                        <label for="Roles" class="form-label">角色(Roles)</label>
                        {{ html()->multiselect('roles[]', $roles)->class('form-control') }}
                    </div>
                    @can('user-create')
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    @endcan
                {{ html()->form()->close() }}
            </div>
        </div>




    </section>
@endsection
