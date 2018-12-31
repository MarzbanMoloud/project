@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                        <br>
                        @role('user')
                            <a href="{{ route('questions') }}">پنل کاربر</a>
                        @endrole

                        <br>

                        @role('admin')
                        <a href="{{ route('questionList') }}">پنل مدیریت</a>
                        @endrole
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
