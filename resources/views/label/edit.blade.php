@extends('layouts.standard_layout')

@section('head_title')
    {{ __('app.titles.label.update') }}
@endsection

@section('content')
    {{ Form::model($label, ['url' => route('label.update', $label), 'method' => 'PATCH']) }}
    @include('label.form')
    {{ Form::submit(__('app.form.update')) }}
    {{ Form::close() }}
@endsection
