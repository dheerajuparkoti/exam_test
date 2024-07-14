<div class="kt-portlet__body">
    <div class="form-group row">
        <div class="col-lg-6">
            {{ html()->label('Question Category') }}
            {{ html()->select('qsn_category_id', $questionCategories, $category->pivot->qsn_category_id ?? null)->class('form-control') }}
            @error('qsn_category_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-lg-6">
            {{ html()->label('Question Model') }}
            {{ html()->select('qsn_model_id', $questionModels, $category->pivot->qsn_model_id ?? null)->class('form-control') }}
            @error('qsn_model_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            {{ html()->label('Minimum Number') }}
            {{ html()->number('min', $category->pivot->min ?? null)->class('form-control') }}
            @error('min')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Maximum Number') }}
            {{ html()->number('max', $category->pivot->max ?? null)->class('form-control') }}
            @error('max')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary">{{ $formAction }}</button>
                <a href="{{ route('admin.subject.show', $subject->id) }}" type="reset" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
