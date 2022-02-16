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

{{ Form::label('description', __('app.model.description')) }}
{{ Form::text('description') }}

{{ Form::label('status_id', __('app.model.status')) }}
{{ Form::select('status_id', collect($statuses)->mapWithKeys(function ($status, $key) {return [$status->id => $status->name];})->all(), null, ['placeholder' => '----']) }}

{{ Form::label('assigned_to_id', __('app.model.assign')) }}
{{ Form::select('assigned_to_id', collect($users)->mapWithKeys(function ($user, $key) {return [$user->id => $user->name];})->all(), null, ['placeholder' => '----']) }}

{{ Form::label('labels[]', __('app.model.labels')) }}
{{ Form::select('labels[]', collect($labels)->mapWithKeys(function ($label, $key) {return [$label->id => $label->name];})->all(), null, ['placeholder' => '----', 'multiple' => true]) }}

<br>
