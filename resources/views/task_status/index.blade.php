<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('header.statuses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
