<?php

include("sidebar.php");

?>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				
			</nav>

			<main class="content" >
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
        <option value="Login">Login</option>
        <option value="Scholar">Scholar</option>
        <option value="Logout">Logout</option>
      </select>
    </div>
	</div>
						 <table class="table p-2" id="filterTable">
									<thead>
										<tr>
											<th style="text-align: center;">Activity</th>
											<th style="text-align: center;">Date</th>
											
										
										</tr>
									</thead>
									<tbody>
                                        <?php
                                                       $qry = "SELECT * from logs ORDER BY dateCreated DESC";
                                                       $ses_sql = mysqli_query($con,$qry);
                                                      while ($row = mysqli_fetch_array($ses_sql)) {
										
                                        
                                        ?>

										<tr>
											<td style="text-align: center;"><?php echo $row['logs'];?></td>
											<td style="text-align: center;">
											<?php echo $row['dateCreated']?>
										    </td>
											
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

      var table = $('#filterTable').DataTable();

      $("#filterTable_filter.dataTables_filter").append($("#categoryFilter"));
      
 
      var categoryIndex = 0;
      $("#filterTable th").each(function (i) {
        if ($($(this)).html() == "Scholarship Status") {
          categoryIndex = i; return false;
        }
      });
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
      $("#categoryFilter").change(function (e) {
        table.draw();
      });
      table.draw();
    });
</script>


</body>

</html>