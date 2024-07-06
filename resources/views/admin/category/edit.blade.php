@extends('admin.layouts.master')
@section('title')
    Category Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Category Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($category, 'put')->route('admin.category.update', $category)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.category.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
