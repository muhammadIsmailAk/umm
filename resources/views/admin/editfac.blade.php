@extends('admin.lay')
@section('content')
<style>
   .page-wrapper {
  left: 0;
  /* margin-left: 230px; */
  padding-top: 50px;
  position: relative;
  -webkit-transition: all 0.4s ease;
  -moz-transition: all 0.4s ease;
  transition: all 0.4s ease;
  color: wheat;
  color: white;
  font-size: large;
  margin: auto;
  border-radius:3px;
}
</style>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                @if(Session::has('success'))
<div  class="alert alert-success" style="margin-left:30rem">
<p>{{session('success')}}</p>    

</div>

@endif
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title" style="color:white;font-size:x-large">Edit Faculty</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="{{route('upfac',$fac->id)}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" id="" value="{{$fac->name}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Faculty Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="facname" id="" required value="{{$fac->faculty_name}}">
                                        <span class="text-danger">
                                            @error('facname')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email Address <span class="text-danger">*</span></label>
                                        <input class="form-control" readonly value="{{$fac->email}}" type="email" name="email" id="" required>
                                        <span class="text-danger">
                                            @error('email')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="visibility: hidden;">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" >
                                    </div>
                                </div>
                                

                                <div class="col-sm-6" >
                                <label class="display-block">Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio"  value="active" <?php if($fac->status=="active") echo'checked'?>  name="status" id="" value="active" >
									<label class="form-check-label" for="doctor_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio"  <?php if($fac->status=="inactive") echo'checked'?> value="inactive" name="status" value="inactive" id="">
									<label class="form-check-label" for="doctor_inactive">
									Inactive
									</label>
								</div>
                            </div>
                            <div class="col-sm-6 " style="visiblity:hidden"></div>
                                
                                 <!-- <div class="col-sm-6">
									<div class="form-group">
										<label>Upload Item Image</label>
										<div class="profile-upload">
											 <div class="upload-img">
												<img alt="" src="" >
											</div> -->
											<!-- <div class="upload-input">
												<input type="file" class="form-control" accept=".png, .jpg, .jpeg">
											</div>
										</div>
									</div>
                                </div>
                            </div> --> 
							
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Update Faculty</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		
@endsection