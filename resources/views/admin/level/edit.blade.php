@extends('admin.layouts.master')
@section('title')
    Level Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Level Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($level, 'put')->route('admin.level.update', $level)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.level.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
