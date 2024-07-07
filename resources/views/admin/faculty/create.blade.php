@extends('admin.layouts.master')
@section('title')
    Faculty Create
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Faculty Create
                </h3>
            </div>
        </div>
        {{ html()->modelForm(null, 'post')->route('admin.faculty.store')->class('kt-form kt-form--label-right')->open() }}
            @include('admin.faculty.form', ['formAction' => 'Save'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#category').select2({
                placeholder: {
                    id: '-1', // the value of the option
                    text: 'Select an option'
                },
                allowClear: true
            }).trigger('change');
            $('#level').select2();
            $("#category").change(function () {
                var categoryId = $(this).val();
                getLevelsByCategory(categoryId);
            })
        });

        function getLevelsByCategory(categoryId, defaultSelected = null) {
            var levels = $('#level').select2({
                placeholder: 'Select Level',
                allowClear: true,
                ajax: {
                    url: "/admin/api/category/" + categoryId + '/levels',
                    'dataType': 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (obj) {
                                return {
                                    id: obj.id,
                                    text: obj.name
                                };
                            })
                        }
                    }
                },
            }).val(defaultSelected).trigger('change');

            if (defaultSelected) {
                _.each(defaultSelected, function (data) {
                    var option = new Option(data.text, data.id, true, true);
                    levels.append(option);
                })
                levels.trigger('change');
            }
        }

    </script>
@endpush
