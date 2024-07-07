@extends('admin.layouts.master')
@section('title')
    Question Category Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Question Category Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($category, 'put')->route('admin.question.category.update', $category)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.question.category.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
