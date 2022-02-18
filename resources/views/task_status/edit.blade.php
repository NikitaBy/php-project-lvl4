@extends('layouts.standard_layout')

@section('head_title')
    {{ __('app.titles.status.update') }}
@endsection

@section('content')
    {{ Form::model($taskStatus, ['url' => route('taskStatus.update', $taskStatus), 'method' => 'PATCH']) }}
    @include('task_status.form')
    {{ Form::submit(__('app.form.update')) }}
    {{ Form::close() }}
@endsection
