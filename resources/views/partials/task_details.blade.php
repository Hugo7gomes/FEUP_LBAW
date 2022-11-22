@if (!is_null($task))
<div class="tasksView">
    <h4>{{$task->name}}</h4>
    <h4>{{$task->details}}</h4>
    <div class="taskComments">
        @foreach ($tasks as $task)
            <h5>{{$task->comment}}</h5> falta receber os comments -->
        @endforeach
    </div>
</div>
@endif