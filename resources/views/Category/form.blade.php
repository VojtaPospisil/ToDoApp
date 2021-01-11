@extends('home')

@section('section')
    <div id="register">
        @if($category->exists)
            <h1>Upravit kategorii</h1>
            @method('put')
        @else
            <h1>Vytvořit kategorii</h1>
        @endif
        <form role="form" method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $category->id }}">
            <div class="field-wrap">
                <label>
                    Název<span class="req">*</span>
                </label>
                <input type="text"required autocomplete="off" name="name"
                       value="{{ old('name', $category->name) }}"
                       class="@error('name') border-red-500 @enderror form_input">
                @error('name')
                <p class="text-red-500 text-xs italic mt-4">{{ $message }}</p>
                @enderror
            </div>
            <div class="field-wrap">
                <label>
                    Popis<span class="req">*</span>
                </label>
                <textarea type="text"required autocomplete="off" name="description"
                          value="{{ old('description', $category->description) }}"
                          class="@error('description') border-red-500 @enderror form_input"
                >{{ $category->description }}</textarea>
                @error('description')
                <p class="text-red-500 text-xs italic mt-4">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="button button-block">Uložit</button>
        </form>
    </div>
@endsection
