<table class="display" id="example">
									<thead>
										<tr>
											<th style="text-align: center;">Name</th>
											<th style="text-align: center;">Student Number</th>
											<th style="text-align: center;"class="d-none d-xl-table-cell">Year Level</th>
										
											<th style="text-align: center;"class="d-none d-md-table-cell">Course</th>
											<th style="text-align: center;"class="d-none d-md-table-cell">Phone Number</th>
                                            <th style="text-align: center;"class="d-none d-md-table-cell">Scholarship Status</th>
                                            <th style="text-align: center;"class="d-none d-md-table-cell">View</th>
										
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
											<td style="text-align: center;"><?php echo $fname.' '.$lname;?></td>
											<td style="text-align: center;">
											<?php echo $studnum?>
										    </td>
											<td style="text-align: center;"><?php echo $yr_lvl;?></td>
											<td style="text-align: center;"><?php echo $course;?></td>
											<td  style="text-align: center;"><?php echo $number;?></td>
                                            <td  style="text-align: center;"><?php echo $row['sc_status'];?></td>
                                            <td  style="text-align: center;"><a  class="btn btn-primary"  href="viewscholar.php?stud_num=<?php echo $row['stud_num'] ?>"><i data-feather = 'eye'></i></button></td>
										</tr>

										<?php }?>

									</tbody>
								</table>