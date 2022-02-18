@extends('layouts.standard_layout')

@section('head_title')
    {{ __('app.titles.label.create') }}
@endsection

@section('content')
    {{ Form::model($label, ['url' => route('label.store')]) }}
    @include('label.form')
    {{ Form::submit(__('app.form.create')) }}
    {{ Form::close() }}
@endsection
