@extends('layouts.app')

@section('content')
    <section class="content">

        @include('layouts/sidebar')

        <div class="content__middle">
            <router-view></router-view>
                @yield('section')
        </div>
    </section>
@endsection
