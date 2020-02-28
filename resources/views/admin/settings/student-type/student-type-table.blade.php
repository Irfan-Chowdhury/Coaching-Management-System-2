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
            <a href="{{route('school-unpublished',$studentType->id)}}" title="Deactivate" class="btn btn-warning fa fa-arrow-alt-circle-down"></a>
        @else
            <a href="{{route('school-published',$studentType->id)}}" title="Activate" class="btn btn-success fa fa-arrow-alt-circle-up"></a>
        @endif
            <a href="{{route('school-edit',$studentType->id)}}" title="Edit" class="btn btn-info fa fa-edit"></a>
            <a href="{{route('school-delete',$studentType->id)}}" onclick="return confirm('Are you Sure to delete ?')" class="btn btn-danger fa fa-trash-alt"></a>
        </td>
    </tr>
    @endforeach
@else
    <tr class="text-danger">
        <td colspan="5">Student Type Not Found !!! </td>
    </tr>
@endif