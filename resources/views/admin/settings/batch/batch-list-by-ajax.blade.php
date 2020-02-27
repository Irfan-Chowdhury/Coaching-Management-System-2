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
                <a href="{{route('class-unpublished',$batch->id)}}" title="Deactivate" class="btn btn-warning fa fa-arrow-alt-circle-down"></a>
            @else
                <a href="{{route('class-published',$batch->id)}}" title="Activate" class="btn btn-success fa fa-arrow-alt-circle-up"></a>
            @endif
                <a href="{{route('class-edit',$batch->id)}}" title="Edit" class="btn btn-info fa fa-edit"></a>
                <a href="{{route('class-delete',$batch->id)}}" onclick="return confirm('Are you Sure to delete ?')" class="btn btn-danger fa fa-trash-alt"></a>
        </td>
    </tr>
@endforeach
</tbody>