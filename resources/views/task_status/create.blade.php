@extends('layouts.standard_layout')

@section('head_title')
    {{ __('app.titles.status.create') }}
@endsection

@section('content')
    {{ Form::model($taskStatus, ['url' => route('taskStatus.store')]) }}
    @include('task_status.form')
    {{ Form::submit(__('app.form.create')) }}
    {{ Form::close() }}
@endsection
