<div class="form-group col-md-6 mb-3">
    <label for="classId" class="col-sm-4 col-form-label text-right">Class Name</label>
    <select name="class_id" class="form-control col-sm-8" id="classId" required>
        <option value="">Select Class</option>
    @foreach ($classes as $class)
        <option value="{{$class->id}}" {{$class->id == $data->class_id ?'selected':''}}>{{$class->class_name}}</option> <!--Here $data use or selected-->
    @endforeach
    </select>
</div>



<div class="form-group col-md-6 mb-3">
    <label class="col-sm-4 col-form-label text-right">Student Type</label>
    <div class="col-sm-8" id="type">
        @if (count($types)>0)
            @foreach ($types as $type)
                <input type="checkbox" id="studentType-{{$type->id}}" name="student_type[{{$type->id}}]" value="{{$type->id}}" class="mr-2">{{$type->student_type}}
            @endforeach 
        @else
            <span class="text-danger">Please Add Some Type First</span>
        @endif
    </div>
</div>


@foreach ($types as $type)
    <div class="col-12" id="batchRollInfo-{{$type->id}}"></div>
@endforeach 



<script>

    //This line again use for change data after change dropdown
     $('#classId').change(function(){
        var classId = $(this).val();
        if (classId) {
            $.get("{{route('birng-student-type')}}",{class_id:classId},function(data){
                console.log(data);
                $('#batchInfo').empty().html(data);
            })
        }
    });

    //Javascript allow PHP inside in this
    //1. if click any check box, another field will show according checkbox info
    //2. if click to uncheck, related field will be hidden according to checkbox
    @foreach($types as $type)
        $('#studentType-{{$type->id}}').change(function () {
            var typeId  = $(this).val(); //in video wrote "typeId" but I wrote, "typeId"
            if ($(this).prop('checked')) {
                    var classId = $('#classId').val();
                    if (classId && typeId) {
                        $.get("{{route('batch-roll-form')}}",{ 
                            class_id:classId, 
                            student_type_id:typeId 
                        },function(data){
                            $('#batchRollInfo-'+typeId).empty().html(data);
                            console.log(data); 
                        });
                    }
            }
            else{
                $('#batchRollInfo-'+typeId).empty();
            } 
        })
    @endforeach

    // function batchRollForm(studentTypeId)
    // {
    //     var classId = $('#classId').val();
    //     if (classId && studentTypeId) {
    //         $.get("{{route('batch-roll-form')}}",{ class_id:classId, student_type_id:studentTypeId },function(data){
    //             $('#batchRollInfo-'+studentTypeId).empty().html(data);
    //             console.log(data);
    //         });
    //     }
    // }
</script>