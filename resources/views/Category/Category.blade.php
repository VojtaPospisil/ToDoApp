@extends('home')

@section('section')

    <div class="artist is-verified">
        <div class="artist__header">
            <div class="artist__navigation">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <router-link :to="{name: 'category.index'}">
                            <a href="#artist-overview" aria-controls="artist-overview" role="tab" data-toggle="tab">Přehled</a>
                        </router-link>
                    </li>
                    <li role="presentation">
                        <router-link :to="{name: 'category.create'}">
                            <a href="#related-artists" aria-controls="related-artists" role="tab" data-toggle="tab">Nová kategorie</a>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>

        <router-view></router-view>

    </div>

@endsection
