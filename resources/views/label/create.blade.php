{{ Form::model($label, ['url' => route('label.store')]) }}
@include('label.form')
{{ Form::submit('!SAVE!') }}
{{ Form::close() }}
