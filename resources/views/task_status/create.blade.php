{{ Form::model($taskStatus, ['url' => route('taskStatus.store')]) }}
    @include('task_status.form')
    {{ Form::submit('!SAVE!') }}
{{ Form::close() }}
