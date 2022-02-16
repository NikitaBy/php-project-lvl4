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
{{ Form::label('name', __('app.model.name')) }}
{{ Form::text('name') }}

<br>
