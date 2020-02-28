<option value="">--Select Student Type--</option>
@foreach ($student_types as $studentType)
    <option value="{{$studentType->id}}">{{$studentType->student_type}}</option>
@endforeach