<?php

include("sidebar.php");

?>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				
			</nav>

			<main class="content" style="background:url('../assets/pubmatfour.png'); background-repeat: no-repeat;
  background-size:  100%;">
				<div class="container-fluid p-0">

					
					<div class="row">
					<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill p-2">
								<div class="card-header">

									<h5 class="card-title mb-0">Scholars</h5>
									<!-- <a href="export.php" class="btn btn-primary">Export</a> -->
								</div>
								<div class="form-group">
								<div class="category-filter">
      <select id="categoryFilter" class="btn btn-secondary ">
        <option value="">Show All</option>
        <option value="Pending">Pending</option>
        <option value="Scholar">Scholar</option>
        <option value="Declined">Declined</option>
      </select>
    </div>
	</div>
						 <table class="table p-2" id="filterTable">
									<thead>
										<tr>
											<th style="text-align: center;">Name</th>
											<th style="text-align: center;">Student Number</th>
											<th style="text-align: center;"class="d-none d-xl-table-cell">Year Level</th>
										
											<th style="text-align: center;"class="d-none d-md-table-cell">Course</th>
											<th style="text-align: center;"class="d-none d-md-table-cell">Phone Number</th>
											<th style="text-align: center;"class="d-none d-md-table-cell">Date of Application</th>
                                            <th style="text-align: center;"class="d-none d-md-table-cell">Scholarship Status</th>
                                            <th style="text-align: center;"class="d-none d-md-table-cell">Action</th>
										
										</tr>
									</thead>
									<tbody>
                                        <?php
                                                       $qry = "SELECT * from scholarinfo";
                                                       $ses_sql = mysqli_query($con,$qry);
                                                      while ($row = mysqli_fetch_array($ses_sql)) {
														$fname = $row['firstName'];
$lname = $row['LastName'];
$studnum = $row['stud_num'];
$address = $row['address'];
$number = $row['number'];
$rel_stat = $row['rel_stat'];
$yr_lvl = $row['yr_lvl'];
$course = $row['course'];
$dob = $row['dob'];

$rowid = $row['scholarID'];
                                        
                                        ?>

										<tr>
											<td style="text-align: center;"><?php echo $lname.', '.$fname;?></td>
											<td style="text-align: center;">
											<?php echo $studnum?>
										    </td>
											<td style="text-align: center;"><?php echo $yr_lvl;?></td>
											<td style="text-align: center;"><?php echo $course;?></td>
											<td  style="text-align: center;"><?php echo $number;?></td>
											<td  style="text-align: center;"><?php echo $row['applicationDate'];?></td>
                                            <td  style="text-align: center;"><?php echo $row['sc_status'];?></td>
                                            <td  style="text-align: center;"><a  class="btn btn-primary"  href="viewscholar.php?stud_num=<?php echo $row['stud_num'] ?>"><i data-feather = 'eye'></i></button></td>
										</tr>

										<?php }?>

									</tbody>
					
								</table> 
								<!-- <div class="category-filter">
      <select id="categoryFilter" class="form-control">
        <option value="">Show All</option>
        <option value="Classical">Classical</option>
        <option value="Hip Hop">Hip Hop</option>
        <option value="Jazz">Jazz</option>
      </select>
    </div>
    <!-- Set up the datatable -->
    <!-- <table class="table" id="filterTable">
      <thead>
        <tr>
          <th scope="col">Artist</th>
          <th scope="col">Category</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td scope="col">Public Enemy</td>
          <td scope="col">Hip Hop</td>
        </tr>
   
      </tbody>
    </table>  -->
								</div>
                            </div>
						</div>
					</div>

				</div>
			</main>

		</div>
	</div>

	<script src="js/app.js"></script>
<script>

// $(document).ready(function() {
//     $('#filterTable').DataTable( {
//         dom: 'Bfrtip',
// 		buttons: [
//             {
//                 extend: 'collection',
//                 text: 'Export',
//                 buttons: [
//                     'copy',
//                     'excel',
//                     'csv',
//                     'pdf',
//                     'print'
//                 ]
//             }
//         ],
		
//     } );
// } );



    $("document").ready(function () {
      $("#filterTable").dataTable({
		dom: 'Bfrtip',
		buttons: [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ],
        "searching": true
      });
      //Get a reference to the new datatable
      var table = $('#filterTable').DataTable();
      //Take the category filter drop down and append it to the datatables_filter div. 
      //You can use this same idea to move the filter anywhere withing the datatable that you want.
      $("#filterTable_filter.dataTables_filter").append($("#categoryFilter"));
      
      //Get the column index for the Category column to be used in the method below ($.fn.dataTable.ext.search.push)
      //This tells datatables what column to filter on when a user selects a value from the dropdown.
      //It's important that the text used here (Category) is the same for used in the header of the column to filter
      var categoryIndex = 0;
      $("#filterTable th").each(function (i) {
        if ($($(this)).html() == "Scholarship Status") {
          categoryIndex = i; return false;
        }
      });
      //Use the built in datatables API to filter the existing rows by the Category column
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          var selectedItem = $('#categoryFilter').val()
          var category = data[categoryIndex];
          if (selectedItem === "" || category.includes(selectedItem)) {
            return true;
          }
          return false;
        }
      );
      //Set the change event for the Category Filter dropdown to redraw the datatable each time
      //a user selects a new filter.
      $("#categoryFilter").change(function (e) {
        table.draw();
      });
      table.draw();
    });
</script>


</body>

</html>