@extends('home')

@section('section')
    <div>
        <a href="{{ route('task.index') }}" class="btn btn-success mb-1">Zpět na přehled úkolů </a>
        <div class="card-container">
            <div class="card planned">
                <div class="card-info">
                    <div class="card-title">{{ $task->title }}</div>
                    <div class="card-detail">
                        <p>Pospis: {{ $task->description }}</p>
                        <p>Hlavní kategorie: {{ $task->mainCategory->name }}</p>
                        <p>Kategorie: {{ $task->category[0]->name }}</p>
                        <p>Zadavatel: {{ $task->userCreated->name }}</p>
                        <p>Přiřazený řešitel: {{ $task->userAssigned->name }}</p>
                        <p>Status: {{ $task->status->name }}</p>
                        <p>Datum splnění: {{ $task->due_date }}</p>
                    </div>
                </div>
                <div id="comments">
                    @foreach($task->comment as $comment)
                        <div class="comment">
                            <p>{{ $comment->comment }} ( {{ $comment->created_at }} )</p>
                            <div>
                                @foreach($comment->child as $child)
                                    <p>{{ $child->comment}}</p>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
