@extends('layouts.NiceAdmin.index')
@section('pageContent')
    {{ Breadcrumbs::render('users.index') }}

    <section class="section">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Create New User</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back </a>
                </div>
            </div>
        </div>


        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>Whoops!</strong>Something went wrong.<br><br>
            <ul>
               @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
               @endforeach
            </ul>
          </div>
        @endif


        <div class="card">
            <div class="card-body">
                {{ html()->form('POST')->class('row g-3')->route('users.update')->open() }}
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
                        <label for="Roles" class="form-label">Roles</label>
                        {{ html()->multiselect('roles[]', $roles)->class('form-control') }}
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                {{ html()->form()->close() }}
            </div>
        </div>




    </section>
@endsection
