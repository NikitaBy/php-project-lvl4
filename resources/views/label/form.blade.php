@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@csrf
{{ Form::label('name', 'Название') }}
{{ Form::text('name') }}

{{ Form::label('description', 'description') }}
{{ Form::text('description') }}

<br>
