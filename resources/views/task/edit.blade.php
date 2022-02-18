@extends('layouts.standard_layout')

@section('head_title')
    {{ __('app.titles.task.update') }}
@endsection

@section('content')
    {{ Form::model($task, ['url' => route('task.update', $task), 'method' => 'PATCH']) }}
    @include('task.form')
    {{ Form::submit(__('app.form.update')) }}
    {{ Form::close() }}
@endsection
