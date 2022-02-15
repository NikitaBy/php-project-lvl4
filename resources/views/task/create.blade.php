{{ Form::model($task, ['url' => route('task.store')]) }}
@include('task.form')
{{ Form::submit('!SAVE T!') }}
{{ Form::close() }}
