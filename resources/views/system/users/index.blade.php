@extends('layouts.NiceAdmin.index')
@section('pageContent')
    {{ Breadcrumbs::render('users.index') }}

    <section class="section">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
        @endif

        <div class="pull-right">
            @can('user-action')
                @can('user-create')
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User </a>
                @endcan
            @endcan
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users Manage</h5>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    @can('user-action')
                                        <th scope="col">Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
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
                                        <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Show</a>
                                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                                        {{ html()->form('DELETE')->route('users.destroy', $user->id)->open() }}
                                        {{ html()->submit('Delete')->class('btn btn-danger') }}
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