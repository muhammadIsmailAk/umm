@extends('supervisor.lay')
@section('content')


<div class="row">   
                    <div class="col-sm-4 col-3">
                    @if(Session::has('success'))
<div  class="alert alert-success" style="width=100%">
<p>{{session('success')}}</p>    

</div>

@endif
                        <h4 class="page-title">Products</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{route('add')}}" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i> Add  Product</a>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-12">
						<div class="table-responsive">
                            <table class="table table-striped custom-table" id="myTab" style="background-color: white;">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Title</th>
                                        <th>Asset Code</th>
                                        <th>Faculty Incharge</th>
                                        <th>Admin Supervisor</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                       
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $is=0;@endphp
                                @foreach($items as $item)

                                    <tr>
                                    <td>{{$is+1}}</td>
                                        <td>
										{{$item->title}}
										</td>
                                        <td>{{$item->assetCode}}</td>
                                        <td>{{$item->facInc}}</td>
                                        <td>{{$item->AdminSup}}</td>
                                        <td width="20%" height="40%" ><img src="{{asset($item->image)}}"  alt="" width="100%" height="100%"></td>
                                        <td>
                                        {{$item->status}} 
                                            
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(56px, 27px, 0px);">
                                                    <a class="dropdown-item" href="{{ route('supeditinv',$item->id) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="{{ route('supdeleteinv',$item->id) }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
                { title: "Title", data: "Title", visible: true },
               { title: "Asset Code", data: "Asset Code", visible: true },
               { title: "Faculty Incharge", data: "Faculty Incharge", visible: false },    
                { title: "Admin Supervisor", data: "Admin Supervisor", visible: true },
                { title: "Image", data: "Image ", visible: true },
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