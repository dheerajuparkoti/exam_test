@extends('admin.layouts.master')
@section('title')
    Category Create
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Category Create
                </h3>
            </div>
        </div>
        {{ html()->modelForm(null, 'post')->route('admin.category.store')->class('kt-form kt-form--label-right')->open() }}
            @include('admin.category.form', ['formAction' => 'Save'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
