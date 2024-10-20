{{-- @extends('layouts.master')

@section('content')
<div class="verification-form">
    <h2>Verification</h2>
    <form action="{{ route('verify.code.submit') }}" method="post">
        @csrf
        <div class="input-box">
            <span class="icon"><ion-icon name="key"></ion-icon></span>
            <input type="text" name="verification_code" required>
            <label>Enter Verification Code</label>
        </div>
        <button type="submit" class="btn">Verify</button>
    </form>
</div>
@endsection --}}