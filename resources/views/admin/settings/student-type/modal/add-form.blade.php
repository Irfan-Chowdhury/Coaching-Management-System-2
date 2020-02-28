<!-- Modal Start-->
<div class="modal fade" id="studentTypeAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
           
            <!-- Modal Title & Button Start-->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Student Type Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Title & Button End-->

            <!-- Form Start -->
            <form action="{{route('student-type-add')}}" method="POST" id="studentTypeInsert">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="schoolName" class="col-form-label col-sm-3 text-right">Class Name</label>
                        <div class="col-sm-9">
                            <select name="class_id" class="form-control @error('class_id') is-invalid @enderror" id="classId" required>
                                <option value="">--Select Class--</option>
                                @foreach ($classes as $class)
                                    <option value="{{$class->id}}">{{$class->class_name}}</option>    
                                @endforeach
                            </select>
                            @error('class_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="studentType" class="col-form-label col-sm-3 text-right">Student Type</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control @error('student_type') is-invalid @enderror" name="student_type" value="{{ old('student_type') }}" id="studentType" placeholder="Write Student Type here" required>
                            @error('student_type')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-warning" id="reset">Reset</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            <!-- Form End -->

        </div>
    </div>
</div>
<!-- Modal End-->