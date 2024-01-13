@extends('layouts.NiceAdmin.index')
@section('pageContent')
    {{ Breadcrumbs::render('roles.index', 'Role') }}

    <section class="section">
        @include('layouts.common.infoMessage')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        @can('role-action')
                            @can('role-create')
                                <a class="btn btn-success" href="{{ route('roles.create') }}">Create</a>
                            @endcan
                        @endcan
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center text-primary">角色管理</h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    @can('role-action')
                                        <th scope="col">Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->description }}</td>
                                    @can('role-action')
                                    <td>
                                        {{ html()->form('DELETE')->route('roles.destroy', $role->id)->open() }}
                                        <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Show</a>
                                        @can('role-edit')
                                            <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                        @endcan
                                        @can('role-delete')
                                            {{ html()->submit('Delete')->class('btn btn-danger') }}
                                        @endcan
                                        {{ html()->form()->close() }}
                                    </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
