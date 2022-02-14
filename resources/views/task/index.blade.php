<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('header.tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @auth
                        <a href="{{route('task.create')}}">{{ __('app.form.create') }}</a>
                    @endif
                    <table>
                        <thead>
                        <tr>
                            <td>{{ __('app.model.id') }}</td>
                            <td>{{ __('app.model.status') }}</td>
                            <td>{{ __('app.model.name') }}</td>
                            <td>{{ __('app.model.author') }}</td>
                            <td>{{ __('app.model.assign') }}</td>
                            <td>{{ __('app.model.created_at') }}</td>
                            @auth
                                <td>{{ __('app.form.actions') }}</td>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->status->name }}</td>
                                <td><a href="{{ route('task.show', ['task' => $task]) }}">{{ $task->name }}</a></td>
                                <td>{{ $task->author->name }}</td>
                                <td>{{ $task->assign->name ?? '-' }}</td>
                                <td>{{ $task->created_at }}</td>
                                @auth()
                                    <td>
                                        @can('delete', $task)
                                            <a href="{{route('task.destroy', ['task' => $task])}}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">{{ __('app.form.delete') }}</a>
                                        @endif
                                        <a href="{{ route('task.edit', ['task' => $task]) }}">{{ __('app.form.edit') }}</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
