@extends('layouts.NiceAdmin.index')
@section('pageContent')
    {{ Breadcrumbs::render('roles.index') }}

    <section class="section">
        @include('layouts.common.errorMessage')

        <div class="card">
            <div class="card-header">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back </a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center text-primary">編輯角色</h5>
                {{ html()->modelForm($role,'PATCH')->class('row g-3')->route('roles.update', $role->id)->open() }}
                    <div class="col-md-4">
                        {{ html()->Label('角色名稱')->class('form-label') }}
                        {{ html()->text('name')->class('form-control') }}
                    </div>
                    <div class="col-md-4">
                        {{ html()->Label('角色名稱')->class('form-label') }}
                        {{ html()->text('guard_name')->class('form-control')->isReadonly() }}
                    </div>
                    <div class='row'>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                </tr>
                            </thead>
                            @foreach ($permission as $value)
                                <tr>
                                    <td>{{ html()->checkbox('permission[]',  in_array($value->id, $rolePermissions) ? true : false, $value->id) }}</td>
                                    <td>{{ $value->name }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    @can('role-edit')
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
