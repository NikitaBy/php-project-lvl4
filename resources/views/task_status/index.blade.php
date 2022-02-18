@extends('layouts.standard_layout')

@section('head_title')
    {{ __('header.statuses') }}
@endsection

@section('content')
    @auth
        <a href="{{route('taskStatus.create')}}">{{ __('app.form.create') }}</a>
    @endif
    <table>
        <thead>
        <tr>
            <td>ID</td>
            <td>{{ __('app.model.name') }}</td>
            <td>{{ __('app.model.created_at') }}</td>
            @auth
                <td>{{ __('app.form.actions') }}</td>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($taskStatuses as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>{{ $status->created_at }}</td>
                @auth()
                    <td>
                        <a href="{{route('taskStatus.destroy', ['taskStatus' => $status])}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">{{ __('app.form.delete') }}</a>
                        <a href="{{ route('taskStatus.edit', ['taskStatus' => $status]) }}">{{ __('app.form.edit') }}</a>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $taskStatuses->render() }}
@endsection
