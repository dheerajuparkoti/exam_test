<div class="kt-portlet__body">
    <div class="form-group row">
        <div class="col-lg-6">
            {{ html()->label('Name') }}
            {{ html()->text('name')->class('form-control') }}
            @error('name')
                <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
            {{ html()->label('Category') }}
            {{ html()->select('category_id', $categories)->class('form-control') }}
            @error('category_id')
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
                <a href="{{ route('admin.level.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
