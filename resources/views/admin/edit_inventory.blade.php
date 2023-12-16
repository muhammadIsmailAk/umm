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
            @if ($errors->any())
   <div class="alert alert-danger">
     <ul>
     @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
     @endforeach
     </ul>
   </div>
@endif




                <div class="row">
                @if(Session::has('success'))
<div  class="alert alert-success" style="margin-left:30rem">
<p>{{session('success')}}</p>    

</div>

@endif
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title" style="color:white;font-size:x-large">Edit Products</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="{{route('updateinv',$item->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="title" id="title" required 
                                        value="{{$item->title}}">
                                        <span class="text-danger">
                                            @error('title')
                                            {{$message}}
                                            @enderror
                                        </span>
                                         
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Asset Code  <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text"  value="{{$item->assetCode}}" name="assetcode" id="" required>
                                        <span class="text-danger">
                                            @error('assetcode')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Faculty Incharge <span class="text-danger">*</span></label>
                                        <select class="form-control select"  name="facultyI" id="" required>
                                        <option value="">--Select Faculty Incharge--</option>
                                        <option value="{{$item->facInc}}" selected>{{$item->facInc}}</option>
													<option value="California">California</option>
													<option value="Alaska">Alaska</option>
													<option value="Alabama">Alabama</option>
												</select>

                                                <span class="text-danger">
                                            @error('facultyI')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Admin Supervisor <span class="text-danger">*</span></label>
                                        <select class="form-control select"  name="super" id="" required>
                                        <option value="">--SelectAdmin Supervisor--</option>
                                        <option value="{{$item->AdminSup}}" selected>{{$item->AdminSup}}</option>
													<option  value="California">California</option>
													<option value="Alaska">Alaska</option>
													<option value="Alabama">Alabama</option>
												</select><span class="text-danger">
                                            @error('super')
                                            {{$message}}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <input class="form-control" type="text"  name="depart" id="" value="{{$item->Dapart}}">
                                    </div>
                                </div>
                                
                                 <div class="col-sm-6">
									<div class="form-group">
										<label>Upload Item Image</label>
										<div class="profile-upload">
											<!-- <div class="upload-img">
												<img alt="" src="" >
											</div> -->
											<div class="upload-input">
												<input type="file" class="form-control" accept=".png, .jpg, .jpeg"  name="image" id="" >
                                                <labe class="text-danger" >Image: (.jpg, .jpeg, .png)</label>
                                                <img src="{{asset($item->image)}}"  alt="" width="100%" height="50%">
                                                <span class="text-danger">
                                            @error('image')
                                            {{$message}}
                                            @enderror
                                        </span>
											</div>
										</div>
									</div>
                                </div>
                            </div>
							<div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="des" id="" cols="30" maxlength="100">{{$item->desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="display-block">Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio"  value="active" <?php if($item->status=='active') echo'checked'?>  name="status" id="" value="active" >
									<label class="form-check-label" for="doctor_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio"  value="inactive" name="status" value="inactive" id="" <?php if($item->status=='inactive') echo'checked'?>>
									<label class="form-check-label" for="doctor_inactive">
									Inactive
									</label>
								</div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary"  type="submit">Update Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		
@endsection