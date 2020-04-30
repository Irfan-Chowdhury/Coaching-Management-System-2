<div class="table-responsive p-1">
    <table class="table table-striped table-bordered dt-responsive text-center" style="width: 100%;">
        <thead>
        <tr>
            <th>#SL</th>
            <th>Student Name</th>
            <th>Roll</th>
            <th>School</th>
            <th>SMS Mobile</th>
            <th>Student ID</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($attendances as $key => $attendance)                        
        <tr>
            <td>{{ $key+1 }}</td>
            <td class="text-left">{{$attendance->student_name}}</td>
            <td>{{$attendance->roll_no}}</td>
            <td>{{$attendance->school_name}}</td>
            <td>{{$attendance->sms_mobile}}</td>
            <td>{{$attendance->student_id}}</td>
            <td>
                <span class="p-2 badge badge-{{$attendance->attendance== 1 ? 'success' : 'danger'}}">{{$attendance->attendance== 1 ? 'Present' : 'Absent'}}</span>
            </td>
        </tr>
        @endforeach                      
        </tbody>
    </table>
</div>