@extends('admin.layouts.master')
@section('title')
    Subject Details
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Subject Details
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-lg-6">
                    <p>Name: <b>{{ $subject->name }}</b></p>
                    <p>Category: <b>{{ $subject->category->name ?? null }}</b></p>
                </div>
                <div class="col-lg-6">
                    <p>Level: <b>{{ $subject->level->name ?? null}}</b></p>
                    <p>Faculty: {{ $subject->faculty->name ?? null }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                {{--                <span class="kt-portlet__head-icon">--}}
                {{--                    <i class="flaticon-calendar"></i>--}}
                {{--                </span>--}}
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Question Category Listing of {{ $subject->name }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <a href="{{ route('admin.question.subject.category.create', $subject) }}" class="btn btn-success btn-pill btn-sm">
                        Create
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" width="100%" id="subject-question-category-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Question Category</th>
                    <th>Question Model</th>
                    <th>Minimum</th>
                    <th>Maximum</th>
                    <th style="text-align: center">Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('script')
    <script type="application/javascript">
        var url = '{{ route('admin.question.subject.category.index', $subject->id) }}';
        var categoryTable = $('#subject-question-category-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            searching: true,
            stateSave: true,
            ajax: {
                url: url,
            },
            order: [[1, 'asc']],
            columns: [
                {data: 'DT_RowIndex', searchable: false, orderable: false, width: '5%'},
                {data: 'name', name: 'name'},
                {data: 'qsnModel', name: 'qsnModel'},
                {data: 'pivot.min', name: 'pivot.min'},
                {data: 'pivot.max', name: 'pivot.max'},
                {data: 'action', 'name': 'action', searchable: false, orderable: false, className: 'dt-body-center'}
            ],
        });
    </script>
@endpush
