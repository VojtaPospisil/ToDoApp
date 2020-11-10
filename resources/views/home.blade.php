@extends('layouts.app')

@section('content')
    <section class="content">

        @include('layouts/sidebar')

        <div class="content__middle">
                @yield('section')
        </div>
    </section>
@endsection
