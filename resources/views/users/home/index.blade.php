@extends('layouts.master')
<link rel='stylesheet' type='text/css' media='screen' href="{{ asset('assets/css/users') }}/homepage.css">
@section('content')
    <article>
        {{-- css file link --}}

        {{-- css file link end --}}
        <section id="section1">
            <h3>Section 1</h3>
            <p>This is the first section of the article.</p>
        </section>
        <section id="section2">
            <h3>Section 2</h3>
            <p>This is the second section of the article.</p>
        </section>
        <section id="section3">
            <h3>Section 3</h3>
            <p>This is the second section of the article.</p>
        </section>
        <section id="section4">
            <h3>Section 4</h3>
            <p>This is the second section of the article.</p>
        </section>

    </article>
@endsection
