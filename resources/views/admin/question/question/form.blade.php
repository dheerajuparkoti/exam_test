<div class="kt-portlet__body">
    <div class="form-group row">
        <div class="col-lg-6">
            {{ html()->label('Category') }}
            {{ html()->select('category_id', $categories, $faculty->category_id ?? null)->class('form-control')->id('category') }}
            @error('name')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-lg-6">
            {{ html()->label('Level') }}
            {{ html()->select('level_id', [], null)->class('form-control')->id('level') }}
            @error('level_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            {{ html()->label('Faculty') }}
            {{ html()->select('faculty_id', [], null)->class('form-control')->id('faculty') }}
            @error('faculty_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Sub Faculty') }}
            {{ html()->select('sub_faculty_id', [], null)->class('form-control')->id('sub-faculty') }}
            @error('sub_faculty_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            {{ html()->label('Subject') }}
            {{ html()->select('subject_id', [], null)->class('form-control')->id('subject') }}
            @error('subject_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Question Category') }}
            {{ html()->select('qsn_category_id', $qsnCategories, null)->class('form-control')->id('faculty') }}
            @error('qsn_category_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            {{ html()->label('Question') }}
            {{ html()->text('title')->class('form-control') }}
            @error('title')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Description') }}
            {{ html()->text('description')->class('form-control') }}
            @error('description')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            {{ html()->label('Options') }}
        </div>
    </div>
    <div class="form-group row " id="option-form">
        <div class="col-lg-6">
            {{ html()->label('Option') }}
            {{ html()->text('options[0][option]')->class('form-control') }}
            @error('option')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-3">
            <br>
            <br>
            <label class="kt-checkbox kt-checkbox--success">
                {{html()->checkbox('options[0][is_correct]', null, 1)}} Is Correct?
                <span></span>
            </label>
            @error('is_correct')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <button type="button" class="btn btn-success btn-xs" onclick="addForm()">+ Add More</button>
        </div>
    </div>

</div>

<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary">{{ $formAction }}</button>
                <a href="{{ route('admin.question.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
