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
            {{ html()->label('Name') }}
            {{ html()->text('name')->class('form-control') }}
            @error('name')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Full Marks') }}
            {{ html()->text('full_mark')->class('form-control') }}
            @error('full_mark')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            {{ html()->label('Pass Mark') }}
            {{ html()->text('pass_mark')->class('form-control') }}
            @error('pass_mark')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Time Limits (In Minutes)') }}
            {{ html()->number('time_limit')->class('form-control') }}
            @error('time_limit')
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
                <a href="{{ route('admin.sub-faculty.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
