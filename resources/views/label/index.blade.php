<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('app.header.task_statuses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
