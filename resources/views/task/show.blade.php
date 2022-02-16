<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('app.titles.task.show') }}: {{ $task->name }} <a href="{{ route('task.edit', ['task' => $task]) }}">click*</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
