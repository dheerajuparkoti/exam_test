<div class="btn-group" role="group">
            <a class="btn btn-info btn-sm blue btn-outline mr-1 pr-2" href="{{ route('admin.question.subject.category.edit', [$subject->id, $category->pivot->id]) }}">
                <i class="la la-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm blue btn-outline mr-1 pr-2" href="javascript:;"
               onclick="confirmation('delete-category}}')">
                <i class="la la-trash"></i>
{{--                {{ html()->form('delete')->route(route('admin.question.subject.category.destroy', [$subject->id, $category->id]))->id('delete-category')->open() }}--}}

{{--                {{ html()->form()->close() }}--}}
            </a>
</div>
<script type="text/javascript">
    function confirmation(formId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Do It!"
        }).then(function(result) {
            if (result.value) {
                document.getElementById(formId).submit();
                Swal.fire(
                    "Done!",
                    "Your action has been completed.",
                    "success"
                )
            }
        });
    };
</script>
