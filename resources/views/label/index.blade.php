@extends('layouts.standard_layout')

@section('head_title')
    {{ __('header.labels') }}
@endsection

@section('content')
    @auth
        <a href="{{route('label.create')}}">{{ __('app.form.create') }}</a>
    @endif

    <table>
        <thead>
        <tr>
            <td>{{ __('app.model.id') }}</td>
            <td>{{ __('app.model.name') }}</td>
            <td>{{ __('app.model.description') }}</td>
            <td>{{ __('app.model.created_at') }}</td>
            @auth
                <td>{{ __('app.form.actions') }}</td>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($labels as $label)
            <tr>
                <td>{{ $label->id }}</td>
                <td>{{ $label->name }}</td>
                <td>{{ $label->description }}</td>
                <td>{{ $label->created_at }}</td>
                @auth()
                    <td>
                        <a href="{{route('label.destroy', ['label' => $label])}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">{{ __('app.form.delete') }}</a>
                        <a href="{{ route('label.edit', ['label' => $label]) }}">{{ __('app.form.edit') }}</a>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $labels->render() }}
@endsection
