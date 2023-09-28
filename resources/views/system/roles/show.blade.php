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

                {{ html()->modelForm($role)->class('row g-3')->open() }}
                    <div class="col-md-4">
                        {{ html()->Label('角色名稱')->class('form-label') }}
                        {{ html()->text('name')->isReadonly()->class('form-control') }}
                    </div>
                    <div class="col-md-4">
                        {{ html()->Label('角色名稱')->class('form-label') }}
                        {{ html()->text('guard_name')->isReadonly()->class('form-control') }}
                    </div>
                    <div class="text-left">
                        {{ html()->A()->text('EDIT')->href(route('roles.edit', $role->id))->class('btn btn-primary') }}
                    </div>
                {{ html()->closeModelForm() }}

            </div>
        </div>



    </section>
@endsection
