@extends('layouts.NiceAdmin.index')
@section('pageContent')
    {{ Breadcrumbs::render('roles.index') }}

    <section class="section">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back </a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">角色資訊</h5>
                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="roleName" class="form-label">角色名稱</label>
                        <input type="text" class="form-control" id="roleName" value="{{ $role->name }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="guardName" class="form-label">Guard Name</label>
                        <input type="text" class="form-control" id="guardName" value="{{ $role->guard_name }}" readonly>
                    </div>

                    <div class="text-center">
                        <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                    </div>
                </form>
            </div>
        </div>



    </section>
@endsection
