@if (!is_null($task))
<div class="tasksView">
    <h4>{{$task->name}}</h4>
    <h4>{{$task->details}}</h4>
</div>
@endif