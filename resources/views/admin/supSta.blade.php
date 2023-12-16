@extends('admin.lay')
@section('content')


<div class="row">   
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Superviosrs</h4>
                    </div>
                    
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="/sup" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i> Add  Superviosr</a>
                    </div>
                </div>
              
                <div class="row">
                    <div class="col-md-12">
						<div class="table-responsive">
                      
                            <table class="table table-striped custom-table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $is=0;@endphp
                                    @foreach($sup as $super)
                                    <tr>
                                    <td>{{$is+1}}</td>
                                        <td>{{$super->name}}</td>
                                        <td>{{$super->email}}</td>
                                        <td>{{$super->depart_name}}</td>
                                        <td>{{$super->status}}</td>
                                       
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(56px, 27px, 0px);">
                                                    <a class="dropdown-item" href="{{route('editsup',$super->id)}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="{{route('delsup',$super->id)}}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
		  var table = $('#myTable').DataTable( {
		    columns: [
                { title: "SNO", data: "SNO", visible: true },
		      { title: "Name", data: "Name", visible: true },
              { title: "Email", data: "Email", visible: false },
		      { title: "Department", data: "Department", visible: true },
		      { title: "Status", data: "Status", visible: true },
              { title: "Action", data: "Action", visible: true }
		      // add more columns as needed
		    ],
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