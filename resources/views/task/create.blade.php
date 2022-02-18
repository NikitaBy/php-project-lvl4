@extends('layouts.standard_layout')

@section('head_title')
    {{ __('app.titles.task.create') }}
@endsection

@section('content')
    {{ Form::model($task, ['url' => route('task.store')]) }}
    @include('task.form')
    {{ Form::submit(__('app.form.create')) }}
    {{ Form::close() }}
@endsection
