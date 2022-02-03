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

{{ Form::label('status_id', 'status_id') }}
{{ Form::select('status_id', collect($statuses)->mapWithKeys(function ($status, $key) {return [$status->id => $status->name];})->all(), null, ['placeholder' => '----']) }}

{{ Form::label('assigned_to_id', 'assigned_to_id') }}
{{ Form::select('assigned_to_id', collect($users)->mapWithKeys(function ($user, $key) {return [$user->id => $user->name];})->all(), null, ['placeholder' => '----']) }}

<br>
