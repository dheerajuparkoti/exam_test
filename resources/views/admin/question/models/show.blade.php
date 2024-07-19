@extends('admin.layouts.master')
@section('title')
    Model Details
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Model Details
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-lg-6">
                    <p>Name: <b>{{ $model->name }}</b></p>
                    <p>Category: <b>{{ $model->category->name ?? null }}</b></p>
                </div>
                <div class="col-lg-6">
                    <p>Full Marks: <b>{{ $model->full_mark ?? null }}</b></p>
                    <p>Pass Marks: <b>{{ $model->pass_mark ?? null}}</b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <p>Time Limit: <b>{{ $model->time_limit }}</b></p>
                    <p>Level: <b>{{ $model->level->name }}</b></p>
                </div>
                <div class="col-lg-6">
                    <p>Faculty: <b>{{ $model->faculty->name ?? null }}</b></p>
                    <p>Sub Faculty: <b>{{ $model->subFaculty->name ?? null}}</b></p>
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
                    Subject Listing of model {{ $model->name }}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" width="100%" id="subject-question-category-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Min</th>
                    <th>Max</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('script')
    <script type="application/javascript">
        var url = '{{ route('admin.question.model.subject.categories', $model->id) }}';
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
                {data: 'subject.name', name: 'subject.name'},
                {data: 'qsn_category.name', name: 'qsnCategory.name'},
                {data: 'min', name: 'min'},
                {data: 'max', name: 'max'},
            ],
        });
    </script>
@endpush
