@extends('home')

@section('section')
        <a class="btn btn-success mb-1" href="{{ route('task.create') }}">Vytvořit úkol</a>
        <task-component></task-component>
{{--        <router-view></router-view>--}}
{{--    <div class="artist__content">--}}
{{--        <div class="tab-content">--}}
{{--            <!-- Overview -->--}}
{{--            <div role="tabpanel" class="tab-pane active" id="artist-overview">--}}
{{--                <div class="overview">--}}
{{--                    <div class="overview__albums">--}}
{{--                        <div class="album">--}}
{{--                            <div class="album__tracks">--}}
{{--                                <div class="tracks">--}}
{{--                                    <div class="tracks__heading">--}}
{{--                                        <a class="btn btn-success mb-1" href="{{ route('task.create') }}">Vytvořit úkol</a>--}}
{{--                                        <div class="tracks__heading__number">#</div>--}}
{{--                                        <div class="tracks__heading__title">Název</div>--}}
{{--                                        <div>POPIS</div>--}}
{{--                                        <div class="tracks__heading__length">--}}
{{--                                            <i class="ion-ios-stopwatch-outline"></i>--}}
{{--                                        </div>--}}
{{--                                        <div class="tracks__heading__popularity">--}}
{{--                                            <i class="ion-thumbsup"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    @foreach($tasks as $task)--}}
{{--                                        <div class="track">--}}
{{--                                            <div class="track__number">{{$task->id}}</div>--}}
{{--                                            <div class="track__title">{{$task->title}}</div>--}}
{{--                                            <div class="track__title">{{$task->description}}</div>--}}
{{--                                            <div class="track__title">{{$task->user()->name}}</div>--}}
{{--                                            <div class="track__length pr-3">--}}
{{--                                                <a href="{{ route('task.edit', $task->id) }}">Edit</a>--}}
{{--                                                <a href="{{ route('task.delete', $task->id) }}">X</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

@endsection
