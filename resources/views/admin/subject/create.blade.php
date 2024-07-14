@extends('admin.layouts.master')
@section('title')
    Subject Create
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Subject Create
                </h3>
            </div>
        </div>
        {{ html()->modelForm(null, 'post')->route('admin.subject.store')->class('kt-form kt-form--label-right')->open() }}
            @include('admin.subject.form', ['formAction' => 'Save'])
        {{ html()->closeModelForm() }}
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#category').select2();
            $("#category").change(function () {
                var categoryId = $(this).val();
                getLevelsByCategory(categoryId);
            });
            $("#level").change(function () {
                var levelId = $(this).val();
                getFacultiesByLevel(levelId);
            })
            $("#faculty").change(function () {
                var facultyId = $(this).val();
                getSubFacultiesByFaculty(facultyId);
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
        function getFacultiesByLevel(levelId, defaultSelected = null) {
            var faculties = $('#faculty').select2({
                placeholder: 'Select Faculty',
                allowClear: true,
                ajax: {
                    url: "/admin/api/level/" + levelId + '/faculties',
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
                    faculties.append(option);
                })
                faculties.trigger('change');
            }
        }
        function getSubFacultiesByFaculty(facultyId, defaultSelected = null) {
            var subFaculties = $('#sub-faculty').select2({
                placeholder: 'Select SubFaculty',
                allowClear: true,
                ajax: {
                    url: "/admin/api/faculty/" + facultyId + '/sub-faculties',
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
                    subFaculties.append(option);
                })
                subFaculties.trigger('change');
            }
        }
    </script>
@endpush

