<div class="table-responsive p-1">
    <table id="classWiseStudentList" class="table table-striped table-bordered dt-responsive text-center" style="width: 100%;">
        <thead>
        <tr>
            <th>#SL</th>
            <th>Student Name</th>
            <th>Batch</th>
            <th>Roll</th>
            <th>School</th>
            <th>Father's Name</th>
            <th>Father's Mobile</th>
            <th>Mother's Name</th>
            <th>Mother's Mobile</th>
            <th>SMS Mobile</th>
            <th>Student ID</th>
            <th style="width: 100px;">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($students as $key => $student)                        
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{$student->student_name}}</td>
            <td>{{$student->batch_name}}</td>
            <td>{{$student->roll_no}}</td>
            <td>{{$student->school_name}}</td>
            <td>{{$student->father_name}}</td>
            <td>{{$student->father_mobile}}</td>
            <td>{{$student->mother_name}}</td>
            <td>{{$student->mother_mobile}}</td>
            <td>{{$student->sms_mobile}}</td>
            <td>{{$student->id}}</td>
            <td>
                <a href="#" class="btn btn-info fa fa-edit"></a>
                <a href="#" class="btn btn-danger fa fa-trash-alt" onclick="return confirm('Are you sure to delete ?')"></a>
            </td>
        </tr>
        @endforeach                         
        </tbody>
    </table>
</div>

<script>
//Data Table Start
$(document).ready(function() {
    $('#classWiseStudentList').DataTable({
        fixedHeader:true
    });
} );
//Data Table End
</script>