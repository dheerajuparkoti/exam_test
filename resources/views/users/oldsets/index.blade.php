@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/users/oldsets.css') }}">

<div class="container">
    <div class="form-container">
   
    <form action="{{ route('oldsets.search') }}" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search Old Sets" class="search-input">
        <button type="submit" class="search-button">Search</button>
    </form>
    </div>
    <h2>All Old Question Sets</h2>
    <div class="row">
        @forelse($oldSets as $set)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $set->image) }}" alt="Set Image" class="card-img-top">
                    <div class="card-body">
                        <p class="card-text">{{ $set->description }}</p>
                    </div>
                </div>
            </div>
        @empty
            @php
                // Define an array of image paths
                $defaultImages = [];
                for ($i = 1; $i <= 20; $i++) {
                    $defaultImages[] = asset("assets/default-images/default-image-{$i}.jpg");
                }
            @endphp
            
            @foreach($defaultImages as $image)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $image }}" alt="Default Image" class="card-img-top">
                        <div class="card-body">
                            <p class="card-text">No sets available at the moment.</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforelse
    </div>
</div>
@endsection
