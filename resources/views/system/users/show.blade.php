@extends('layouts.NiceAdmin.index')
@section('pageContent')
    {{ Breadcrumbs::render('users.show',$user) }}

    <section class="section">

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
                        <label for="name" class="form-label">帳號</label>
                        <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="userName" class="form-label">中文名</label>
                        <input type="text" class="form-control" id="userName" value="{{ $user->username }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="userEmail" class="form-label">Email(登入系統用)</label>
                        <input type="email" class="form-control" id="userEmail" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="email_verified_at" class="form-label">信箱認證時間</label>
                        <input type="email" class="form-control" id="email_verified_at"
                            value="{{ $user->email_verified_at }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="created_at" class="form-label">建立時間</label>
                        <input type="email" class="form-control" id="created_at"
                            value="{{ $user->created_at }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="updated_at" class="form-label">更新時間</label>
                        <input type="email" class="form-control" id="updated_at"
                            value="{{ $user->updated_at }}" readonly>
                    </div>
                    <div class="col-12">
                        <label for="Roles" class="form-label">角色(Roles)</label>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <label class="badge bg-primary">{{ $v }}</label>
                            @endforeach
                        @endif
                    </div>
                    <div class="text-left">
                        @can('user-edit')
                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
