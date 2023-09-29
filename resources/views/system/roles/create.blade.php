@extends('layouts.NiceAdmin.index')
@section('pageContent')
    {{ Breadcrumbs::render('roles.index') }}

    <section class="section">

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
            <div class="card-header">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back </a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center text-primary">Create New User</h5>
                {{ html()->form('POST')->class('row g-3')->route('roles.store')->open() }}
                    <div class="col-md-4">
                        {{ html()->Label('角色名稱')->class('form-label') }}
                        {{ html()->text('name')->class('form-control') }}
                    </div>
                    <div class="col-md-4">
                        {{ html()->Label('角色權限')->class('form-label') }}
                        @foreach ($permission as $value)
                            {{ html()->checkbox('permission[]', $value->id)->class('form-control') }}
                            {{ $value->name }}
                        @endforeach

                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                {{ html()->form()->close() }}
            </div>
        </div>




    </section>
@endsection
