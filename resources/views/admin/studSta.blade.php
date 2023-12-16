@extends('admin.lay')
@section('content')

<div class="row">   
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Products</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{ route('stud') }}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i> Add Student</a>
                    </div>
                </div>
                <div class="row">
               @if(Session::has('success'))
                    <div  class="alert alert-success" style="margin-left:30rem">
                    <p>{{session('success')}}</p>    
                    
                    </div>
                    @endif
               </div>
                <div class="row">
                    <div class="col-md-12">
						<div class="table-responsive">
                            <table class="table table-striped custom-table" id="myTab">
                                <thead>
                                        
                                    <tr>
                                        <th>SNO</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>Student Code</th>
                                        
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $is=0;@endphp
                                @foreach($stu as $stue)
                                    <tr>
                                    <td>{{$is+1}}</td>
                                      
                                        <td>{{$stue->name}}</td>
                                        <td>{{$stue->email}}</td>
                                        <td>{{$stue->department}}</td>
                                        <td>{{$stue->student_code}}</td>
                                        <td>
                                        {{$stue->status}}
                                           
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(56px, 27px, 0px);">
                                                    <a class="dropdown-item" href="{{route('editstu',$stue->id)}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="{{route('delstu',$stue->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @php $is++ @endphp
                                    @endforeach
                                  
                                </tbody>
                            </table>
						</div>
                    </div>
                </div>
                
	<script>
		$(document).ready(function() {
		  var table = $('#myTab').DataTable( {
		    columns: [
                { title: "SNO", data: "SNO", visible: true },
                { title: "Name", data: "Name", visible: true },
               { title: "Email", data: "Email", visible: true },
               { title: "Department", data: "Department", visible: false },    
                { title: "Student Code", data: "Student Code", visible: true },
           
		      { title: "Status", data: "Status", visible: true },
              { title: "Action", data: "Action", visible: true },
            ],
            
             
		   
              
		      // add more columns as needed
		    
		    dom: 'Bfrtip',
		    buttons: [

            
		      {
		        extend: 'copyHtml5',
		        exportOptions: {
		          columns: ':visible'
		        }
		      },
		      {
		        extend: 'pdfHtml5',
		        exportOptions: {
		          columns: ':visible'
		        }
		      },
		      {
		        extend: 'print',
		        exportOptions: {
		          columns: ':visible'
		        }
		      },

              {
		        extend: 'csv',
		        exportOptions: {
		          columns: ':visible'
		        }
		      },
              {
		        extend: 'excel',
		        exportOptions: {
		          columns: ':visible'
		        }
		      },


		      {
		        extend: 'colvis',
		        text: 'Column visibility'
		      }
		    ]
		  } );
		  
		  table.column(1).visible(false); // hide the "Age" column

		  $('#toggleAgeColumn').on('click', function() {
		    var column = table.column(1);
		    column.visible(!column.visible());
		  });
		} );
	</script>
@endsection