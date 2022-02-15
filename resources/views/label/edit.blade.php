{{ Form::model($label, ['url' => route('label.update', $label), 'method' => 'PATCH']) }}
@include('label.form')
{{ Form::submit('!UPD!') }}
{{ Form::close() }}
