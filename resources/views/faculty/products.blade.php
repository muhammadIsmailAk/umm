@extends('faculty.lay')
@section('content')

	<table id="myTable" class="table table-striped custom-table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Age</th>
				<th>City</th>
                <th>nation</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>John Doe</td>
				<td>30</td>
				<td>New York</td>
                <td>nation</td>
			</tr>
			<tr>
				<td>Jane Smith</td>
				<td>25</td>
				<td>Los Angeles</td>
                <td>nation</td>
			</tr>
			<tr>
				<td>Bob Johnson</td>
				<td>40</td>
				<td>Chicago</td>
                <td>nation</td>
			</tr>
			<!-- add more rows as needed -->
		</tbody>
	</table>


	



	<script>
		$(document).ready(function() {
		  var table = $('#myTable').DataTable( {
		    columns: [
		      { title: "Name", data: "name", visible: true },
              { title: "nation", data: "nation", visible: false },
		      { title: "Age", data: "age", visible: true },
		      { title: "City", data: "city", visible: true }
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