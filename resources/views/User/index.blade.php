@extends('home')

@section('section')

{{--    <div class="artist is-verified">--}}
{{--        <div class="artist__header">--}}
{{--            <div class="artist__navigation">--}}
{{--                <ul class="nav nav-tabs" role="tablist">--}}
{{--                    <li role="presentation" class="active">--}}
{{--                        <router-link :to="{name: 'category.index'}">--}}
{{--                            <a href="#artist-overview" aria-controls="artist-overview" role="tab" data-toggle="tab">Přehled</a>--}}
{{--                        </router-link>--}}
{{--                    </li>--}}
{{--                    <li role="presentation">--}}
{{--                        <router-link :to="{name: 'category.create'}">--}}
{{--                            <a href="#related-artists" aria-controls="related-artists" role="tab" data-toggle="tab">Nová kategorie</a>--}}
{{--                        </router-link>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--<!-- sem neco prijde -->--}}

{{--    </div>--}}

<div class="artist__content">
    <div class="tab-content">
        <!-- Overview -->
        <div role="tabpanel" class="tab-pane active" id="artist-overview">
            <div class="overview">
                <div class="overview__albums">
                    <div class="album">
                        <div class="album__tracks">
                            <div class="tracks">
                                <div class="tracks__heading">
                                    <a class="btn btn-success mb-1" href="{{ route('user.create') }}">Vytvořit uživatele</a>
                                    <div class="tracks__heading__number">#</div>
                                    <div class="tracks__heading__title">Název</div>
                                    <div>POPIS</div>
                                    <div class="tracks__heading__length">
                                        <i class="ion-ios-stopwatch-outline"></i>
                                    </div>
                                    <div class="tracks__heading__popularity">
                                        <i class="ion-thumbsup"></i>
                                    </div>
                                </div>
                                @foreach($users as $user)
                                    @if($user->is_admin === 1)
                                        <div class="track admin">
                                    @else
                                        <div class="track">
                                    @endif
                                        <div class="track__number">{{$user->id}}</div>
                                        <div class="track__title">{{$user->name}}</div>
                                        <div class="track__title">{{$user->email}}</div>
                                        <div class="track__length pr-3">
                                            <a href="{{ route('user.setAdmin', $user->id) }}">A</a>
                                            <a href="{{ route('user.edit', $user->id) }}">Edit</a>
                                            <a href="{{ route('user.delete', $user->id) }}">X</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
