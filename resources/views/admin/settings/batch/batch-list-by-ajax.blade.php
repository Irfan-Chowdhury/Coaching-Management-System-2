<thead>
    <tr>
        <td>#SL</td>
        <td>Batch Name</td>
        <td>Action</td>
    </tr>
</thead>
<tbody>
@foreach ($batches as $key => $batch)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{$batch->batch_name}}</td>
        <td>
            @if ($batch->status==1)
                <button onclick='unpublished("{{$batch->id}}","{{$batch->class_id}}")' title="Deactivate" class="btn btn-warning fa fa-arrow-alt-circle-down"></button>
            @else
                <a onclick='published("{{$batch->id}}","{{$batch->class_id}}")' title="Activate" class="btn btn-success fa fa-arrow-alt-circle-up"></a>
                {{-- <button onclick='published("{{$batch->id}}","{{$batch->class_id}}")' title="Activate" class="btn btn-success fa fa-arrow-alt-circle-up"></button> --}}
            @endif
                <a href="{{route('class-edit',$batch->id)}}" title="Edit" class="btn btn-info fa fa-edit"></a>
                <button onclick='batchdel("{{$batch->id}}","{{$batch->class_id}}")' class="btn btn-danger fa fa-trash-alt"></button>
        </td>
    </tr>
@endforeach
</tbody>

<script>

    function unpublished(batchId,classId)
    {
        var check = confirm("If you want to Unpublish this item, Press OK");
        if (check) 
        {
            $.get("{{route('batch-unpublished')}}", {batch_id:batchId,class_id:classId}, function (data) {
                $("#batchList").html(data);
            }) 
        }
    }
    
    function published(batchId,classId)
    {
        var check = confirm("If you want to publish this item, Press OK");
        if (check) 
        {
            $.get("{{route('batch-published')}}", {batch_id:batchId,class_id:classId}, function (data) {
                $("#batchList").html(data);
            }) 
        }
    }
    
    function batchdel(batchId,classId)
    {
        var check = confirm("Are you Sure to Delete ?");
        if (check) 
        {
            $.get("{{route('batch-delete')}}", {batch_id:batchId,class_id:classId}, function (data) {
                $("#batchList").html(data);
            }) 
        }
    }
</script>
