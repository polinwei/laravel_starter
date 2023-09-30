@extends('layouts.NiceAdmin.index')
@section('pageContent')
    {{ Breadcrumbs::render('users.index') }}

    <section class="section">
        @include('layouts.common.errorMessage')

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
                        <label for="userEmail" class="form-label">Email(登入系統用)</label>
                        {{ html()->email('email') }}
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label">帳號</label>
                        {{ html()->text('name') }}
                    </div>
                    <div class="col-md-4">
                        <label for="username" class="form-label">中文名</label>
                        {{ html()->text('username') }}
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
                        {{ html()->multiselect('roles[]', $roles, $userRole)->class('form-control') }}
                    </div>
                    @can('user-edit')
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    @endcan
                {{ html()->closeModelForm() }}
            </div>
        </div>



    </section>
@endsection
