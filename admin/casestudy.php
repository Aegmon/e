<?php
include("sidebar.php"); // Include the sidebar (which has the $con connection)


?>

<div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>
    </nav>

    <main class="content">
        <div class="container-fluid p-0">
            <div class="row">
                <div id="main">
             

                    <div class="button-container">
                        <button type="button" class="btn btn-primary" id="downloadButton">Download</button>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">SOCIAL CASE STUDY REPORT</h1>
                            <form id="caseStudyForm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="id-picture-input" class="form-label">2x2 Picture</label>
                                    <input type="file" class="form-control" id="id-picture-input" name="id_picture" accept="image/*">
                                    <img id="id-picture-preview" src="#" alt="ID Picture Preview" class="img-fluid mt-3" style="display: none;">
                                </div>

                                <div class="form-group">
                                    <label for="date-input" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date-input" name="date" required>
                                </div>

                                <h3 class="mt-4">I. Identifying Information</h3>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="name-input" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name-input" name="name" placeholder="Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="year-course-input" class="form-label">Year & Course</label>
                                        <input type="text" class="form-control" id="year-course-input" name="year_course" required>
                                    </div>
                                </div>

                                <div class="form-row mt-3">
                                    <div class="col-md-4">
                                        <label for="age-select" class="form-label">Age</label>
                                        <select class="form-control" id="age-select" name="age" required>
                                            <option value="">Select Age</option>
                                            <script>
                                                for (let i = 0; i <= 50; i++) {
                                                    document.write(`<option value="${i}">${i}</option>`);
                                                }
                                            </script>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="civil-status-select" class="form-label">Civil Status</label>
                                        <select class="form-control" id="civil-status-select" name="civil_status" required>
                                            <option value="">Select Civil Status</option>
                                            <option value="1">Single</option>
                                            <option value="2">Married</option>
                                            <option value="3">Widowed</option>
                                            <option value="4">Divorced</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="dob-input" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob-input" name="date_of_birth" required>
                                    </div>
                                </div>

                                <div class="form-row mt-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Gender</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="male" name="gender" value="male" required>
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="female" name="gender" value="female" required>
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="non-binary" name="gender" value="non-binary" required>
                                            <label class="form-check-label" for="non-binary">Non-Binary</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="place-of-birth-input" class="form-label">Place of Birth</label>
                                        <input type="text" class="form-control" id="place-of-birth-input" name="place_of_birth" required>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="home-address-input" class="form-label">Home Address</label>
                                    <input type="text" class="form-control" id="home-address-input" name="home_address" placeholder="Enter home address" required>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="family-circumstances-input" class="form-label">Family Circumstances</label>
                                    <input type="text" class="form-control" id="family-circumstances-input" name="family_circumstances" placeholder="Enter family circumstances" required>
                                </div>

                                <div class="form-group mt-5">
                                    <h3>II. FAMILY COMPOSITION</h3>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Relationship to Client</th>
                                                <th>Civil Status</th>
                                                <th>Occupation</th>
                                                <th>Monthly Income</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" class="form-control" name="name1" required></td>
                                                <td><input type="text" class="form-control" name="relationship1" required></td>
                                                <td><input type="text" class="form-control" name="status1" required></td>
                                                <td><input type="text" class="form-control" name="occupation1" required></td>
                                                <td><input type="text" class="form-control" name="income1" required></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="name2"></td>
                                                <td><input type="text" class="form-control" name="relationship2"></td>
                                                <td><input type="text" class="form-control" name="status2"></td>
                                                <td><input type="text" class="form-control" name="occupation2"></td>
                                                <td><input type="text" class="form-control" name="income2"></td>
                                            </tr>
                                            <tr>
                                                <td><input type="text" class="form-control" name="name3"></td>
                                                <td><input type="text" class="form-control" name="relationship3"></td>
                                                <td><input type="text" class="form-control" name="status3"></td>
                                                <td><input type="text" class="form-control" name="occupation3"></td>
                                                <td><input type="text" class="form-control" name="income3"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="problem-presented" class="form-label">III. Problem Presented</label>
                                    <textarea class="form-control" id="problem-presented" name="problem_presented" placeholder="The family does not have sufficient resources..." rows="3"></textarea>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="disposition" class="form-label">IV. Disposition</label>
                                    <textarea class="form-control" id="disposition" name="disposition" placeholder="The client was able to successfully provide all necessary documentation..." rows="3"></textarea>
                                </div>

                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>   
            </div>      
        </div>
    </main>
</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>