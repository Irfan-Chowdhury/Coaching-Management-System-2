@extends('admin.master')

@section('title','User Password Change')

@section('main-content')
<!--Content Start-->
<section class="container-fluid">
    <div class="row content registration-form">
        <div class="col-12 pl-0 pr-0">
            <div class="form-group">
                <div class="col-sm-12">
                    <h4 class="text-center font-weight-bold font-italic mt-3">User Password Change</h4>
                </div>
            </div>

            @if (Session::get('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error: </strong>{{Session::get('error_message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" autocomplete="off" class="form-inline"> --}}
            <form method="POST" action="{{ route('user-password-update',$user->id) }}" autocomplete="off" class="form-inline">
                @csrf 
   

                <div class="form-group col-12 mb-3">
                    <label for="old_password" class="col-sm-3 col-form-label text-right">Old Password</label>
                    <input id="old_password" type="password" class="col-sm-9 form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="Old Password" required>
                    @error('old_password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
              
                <div class="form-group col-12 mb-3">
                    <label for="new_password" class="col-sm-3 col-form-label text-right">New Password</label>
                    <input id="new_password" type="password" class="col-sm-9 form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="New Password" required>
                    @error('new_password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group col-12 mb-3">
                    <label class="col-sm-3"></label>
                    <button type="submit" class="col-sm-9 btn btn-block my-btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!--Content End-->
</section>
@endsection