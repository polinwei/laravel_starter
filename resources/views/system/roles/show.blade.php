@extends('layouts.NiceAdmin.index')
@section('pageContent')
    {{ Breadcrumbs::render('roles.show', $role) }}

    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back </a>
                    @can('role-edit')
                        {{ html()->A()->text('EDIT')->href(route('roles.edit', $role->id))->class('btn btn-primary') }}
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center text-primary">角色資訊</h5>

                {{ html()->modelForm($role)->class('row g-3')->open() }}
                    <div class="col-md-4">
                        {{ html()->Label('角色名稱')->class('form-label') }}
                        {{ html()->text('name')->isReadonly()->class('form-control') }}
                    </div>
                    <div class="col-md-4">
                        {{ html()->Label('權限位置')->class('form-label') }}
                        {{ html()->text('guard_name')->isReadonly()->class('form-control') }}
                    </div>
                    <h5 class="card-title bg-secondary text-white">權限列表</h5>
                    <div class='row'>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                </tr>
                            </thead>
                            @foreach ($rolePermissions as $key => $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                {{ html()->closeModelForm() }}

            </div>
        </div>
    </section>
@endsection
