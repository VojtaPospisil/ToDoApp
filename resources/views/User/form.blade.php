@extends('home')

@section('section')
    <main class="py-4">
        <div class="form">
            <div class="tab-content">
                <div id="register">
                    <form action="{{ route('register') }}" method="post">
                        <div class="field-wrap">
                            @csrf
                            <label>
                                Jméno<span class="req">*</span>
                            </label>
                            <input id="name" type="text" class="@error('name') is-invalid @enderror form_input"
                                   name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-wrap">
                            <label>
                                Email<span class="req">*</span>
                            </label>
                            <input id="email" type="email" class="@error('email') is-invalid @enderror form_input"
                                   name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-wrap">
                            <label>
                                Heslo<span class="req">*</span>
                            </label>
                            <input id="password" type="password" class="@error('password') is-invalid @enderror form_input"
                                   name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="field-wrap">
                            <label>
                                Potvrzení hesla<span class="req">*</span>
                            </label>
                            <input id="password-confirm" type="password" class="form_input"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="field-wrap">
                            <label>
                                Admin<span class="req">*</span>
                            </label>
                            <input id="is_admin" type="checkbox" value="admin"
                                   name="is_admin" class="form_input">
                        </div>
                        <button class="button button-block"/>Uložit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
