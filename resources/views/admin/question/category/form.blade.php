<div class="kt-portlet__body">
    <div class="form-group row">
        <div class="col-lg-6">
            {{ html()->label('Name') }}
            {{ html()->text('name')->class('form-control') }}
            @error('name')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Weightage') }}
            {{ html()->number('weightage')->class('form-control') }}
            @error('weightage')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <label class="kt-checkbox kt-checkbox--success">
                {{html()->checkbox('is_objective', $category->is_objective??null, 1)}} Is Objective?
                <span></span>
            </label>
            @error('is_objective')
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
                <a href="{{ route('admin.category.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
