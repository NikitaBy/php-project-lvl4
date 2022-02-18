@extends('layouts.standard_layout')

@section('content')
    <h1>{{ __('app.welcome.hello') }}</h1>
    <p>{{ __('app.welcome.subject') }}</p>
    <button href="https://hexlet.io" class="btn btn-primary btn-lg" type="button">{{ __('app.welcome.learn_more') }}</button>
@endsection
