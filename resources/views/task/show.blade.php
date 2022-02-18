@extends('layouts.standard_layout')

@section('head_title')
    {{ __('app.titles.task.show') }}: {{ $task->name }} <a href="{{ route('task.edit', ['task' => $task]) }}">click*</a>
@endsection

@section('content')
    <div>
        <p>{{ __('app.model.name') }}: {{ $task->name }}</p>
        <p>{{ __('app.model.status') }}: {{ $task->status->name }}</p>
        <p>{{ __('app.model.description') }}: {{ $task->description }}</p>
        <p>{{ __('app.model.labels') }}:</p>
        <ul>
            @foreach($task->labels as $label)
                <li>{{ $label->name }}</li>
            @endforeach
        </ul>
    </div>
@endsection
