@extends('layouts.NiceAdmin.index')
@section('pageContent')
    {{ Breadcrumbs::render('roles.create', $role) }}

    <section class="section">
        @include('layouts.common.errorMessage')

        <div class="card">
            <div class="card-header">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back </a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center text-primary">建立新角色</h5>
                {{ html()->form('POST')->class('row g-3')->route('roles.store')->open() }}
                    <div class="col-md-4">
                        {{ html()->Label('角色名稱')->class('form-label') }}
                        {{ html()->text('name')->class('form-control') }}
                    </div>
                    <div class="col-md-4">
                        {{ html()->Label('角色說明')->class('form-label') }}
                        {{ html()->text('description')->class('form-control') }}
                    </div>
                    <h5 class="card-title bg-secondary text-white">權限列表</h5>
                    <div class="row">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                </tr>
                            </thead>
                            @foreach ($permission as $value)
                                <tr>
                                    <td>{{ html()->checkbox('permission[]',  false, $value->id) }}</td>
                                    <td>{{ $value->name }}</td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                    @can('role-create')
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
