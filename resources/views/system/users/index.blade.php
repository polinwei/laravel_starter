@extends('layouts.NiceAdmin.index')
@section('pageContent')
    {{ Breadcrumbs::render('users.index','User') }}

    <section class="section">
        @include('layouts.common.infoMessage')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        @can('user-action')
                            @can('user-create')
                                <a class="btn btn-success" href="{{ route('users.create') }}"> Create</a>
                            @endcan
                        @endcan
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">用戶管理</h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">帳號</th>
                                    <th scope="col">姓名</th>
                                    <th scope="col">Email(登入系統用)</th>
                                    <th scope="col">Roles</th>
                                    @can('user-action')
                                        <th scope="col">Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $v)
                                                <label class="badge bg-primary">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    @can('user-action')
                                    <td>
                                        {{ html()->form('DELETE')->route('users.destroy', $user->id)->open() }}
                                        <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                                        @can('user-edit')
                                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                        @endcan
                                        @can('user-delete')
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
