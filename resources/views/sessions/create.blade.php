@extends('layouts.master')

@section('content')
    <div class="col-sm-8">
        <h1>Register</h1>

        <form>
            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

        </form>

    </div>
@endsection