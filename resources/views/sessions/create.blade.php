@extends('layouts.master')

@section('content')
    <div class="col-md-8">
        <h1>Sign In</h1>

        <form method="POST" action="/login">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6LeirykUAAAAAPZPGFm27N8AdvX2xTKf83Ur50nQ"></div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>

            @include('layouts.errors')

        </form>
    </div>

    <script src='https://www.google.com/recaptcha/api.js'></script>

@endsection