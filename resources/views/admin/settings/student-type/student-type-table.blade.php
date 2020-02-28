@if (count($studentTypes)>0)
    @foreach ($studentTypes as $key => $studentType)                        
    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{$studentType->class_name}}</td>
        <td>{{$studentType->student_type}}</td>
        {{-- <td>{{$school->status==1 ? 'Published':'Unpublished'}}</td> --}}
        @if ($studentType->status==1)
            <td class="text-success font-weight-bold">Published</td>
        @else
            <td class="text-warning font-weight-bold">Unpublished</td>
        @endif

        <td>
        @if ($studentType->status==1)
            <button onclick="studentTypeUnpublished('{{$studentType->id}}')"  title="Unpublish" class="btn btn-warning fa fa-arrow-alt-circle-down"></button>
        @else
            <button onclick="studentTypePublished('{{$studentType->id}}')" title="Publish" class="btn btn-success fa fa-arrow-alt-circle-up"></button>
        @endif
            <button onclick="studentTypeEdit('{{$studentType->id}}','{{$studentType->student_type}}')" title="Edit" class="btn btn-info fa fa-edit" data-toggle="modal" data-target="#studentTypeEditModal"></button>
           
            <button onclick="studentTypeDelete('{{$studentType->id}}')" class="btn btn-danger fa fa-trash-alt"></button>
        </td>
    </tr>
    @endforeach
@else
    <tr class="text-danger">
        <td colspan="5">Student Type Not Found !!! </td>
    </tr>
@endif

