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
                        <p>Hlavní kategorie: {{ $task->main_category_name }}</p>
                        <p>Kategorie:</p>
                            @foreach($task->category as $category)
                                <p>{{ $category->name }}</p>
                            @endforeach
                        <p>Zadavatel: {{ $task->user_created_name }}</p>
                        <p>Přiřazený řešitel: {{ $task->user_assigned_name }}</p>
                        <p>Status: {{ $task->status_name }}</p>
                        <p>Datum splnění: {{ $task->due_date }}</p>
                    </div>
                </div>
                <div id="comments">
                    @foreach($task->comment as $comment)
                        <div class="{{ $comment->id === $commentId ? 'comment_targeted' : 'comment' }}">
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
