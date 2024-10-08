<!DOCTYPE html>
<html>

<head>
    <title>Ride List</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="styles/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- jQuery UI CSS for draggable modals -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
</head>

<body>
    <?php
    include 'admin_navbar.php';
    if (!isset($_SESSION['user_name'])) {
        header('location: admin_login.php');
    }
    include 'connection.php';

    class DatabaseHandler
    {
        private $mysqli;

        public function __construct($conn)
        {
            $this->mysqli = $conn;
        }

        public function getTotalRows()
        {
            // Fetch total rows from the Ride table
            $countSql = "SELECT COUNT(*) AS totalRows FROM Ride";
            $countStmt = $this->mysqli->prepare($countSql);
            $countStmt->execute();
            $countResult = $countStmt->get_result();
            $row = $countResult->fetch_assoc();
            return $row['totalRows'];
        }

        public function getRidesData($currentPage, $rowsPerPage)
        {
            // Fetch ride data for the current page
            $offset = ($currentPage - 1) * $rowsPerPage;
            $sql = "SELECT * FROM Ride LIMIT ?, ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("ii", $offset, $rowsPerPage);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        public function addRide($rideId, $rideName, $rideCategory, $rideInfo, $physicalRequirement)
        {
            // Insert a new ride into the Ride table
            $sql = "INSERT INTO ride (ride_id, ride_name, ride_category, ride_info, physical_requirement) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("issss", $rideId, $rideName, $rideCategory, $rideInfo, $physicalRequirement);
            $stmt->execute();
            $stmt->close();
        }

        public function addAccessibilityInformation(
            $rideId,
            $sight,
            $smell,
            $sound,
            $taste,
            $touch,
            $pregnancy,
            $motion,
            $arms,
            $legs,
            $blood_pressure,
            $flashing_light,
            $loud_noises,
            $intense_visual,
            $heart_disease,
            $wheelchair,
            $intensity,
            $max_weight,
            $min_weight,
            $max_height,
            $min_height,
            $visual,
            $hearing
        ) {


            // Insert accessibility information into the accessibility_information table
            $sql = "INSERT INTO accessibility_information (ride_id, sight, smell, sound, taste, touch, pregnancy, motion_sickness, hands, legs,
            blood_pressure, flashing_light, loud_noises, intense_visual, heart_disease, wheelchair, intensity, max_weight, min_weight, max_height, min_height, visual, hearing ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param(
                "iiiiiiiiiiiiiiiisiiiiii",
                $rideId,
                $sight,
                $smell,
                $sound,
                $taste,
                $touch,
                $pregnancy,
                $motion,
                $arms,
                $legs,
                $blood_pressure,
                $flashing_light,
                $loud_noises,
                $intense_visual,
                $heart_disease,
                $wheelchair,
                $intensity,
                $max_weight,
                $min_weight,
                $max_height,
                $min_height,
                $visual,
                $hearing
            );
            $stmt->execute();
            $stmt->close();
        }
        public function closeConnection()
        {
            // Close the database connection
            $this->mysqli->close();
        }
    }

    // Instantiate the DatabaseHandler class
    $databaseHandler = new DatabaseHandler($conn);


    // Handle form submission for adding ride
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if form fields are set for adding a ride
        if (isset($_POST["ride_id"]) && isset($_POST["rideName"]) && isset($_POST["rideCategory"]) && isset($_POST["ride_info"]) && isset($_POST["physical_requirement"])) {
            // Get form data for adding a ride
            $rideId = $_POST["ride_id"];
            $rideName = $_POST["rideName"];
            $rideCategory = $_POST["rideCategory"];
            $rideInfo = $_POST["ride_info"];
            $physicalRequirement = $_POST["physical_requirement"];

            // Add ride to the database
            $databaseHandler->addRide($rideId, $rideName, $rideCategory, $rideInfo, $physicalRequirement);

            // Show the second popup modal for adding accessibility information
            echo "<script>$('#addAccessibilityModal').modal('show');</script>";
        }

        // Check if form fields are set for adding accessibility information
        if (
            isset($_POST["ride_id"]) &&
            isset($_POST["touch"]) &&
            isset($_POST["taste"]) &&
            isset($_POST["smell"]) &&
            isset($_POST["sight"]) &&
            isset($_POST["sound"]) &&
            isset($_POST["pregnancy"]) &&
            isset($_POST["motion"]) &&
            isset($_POST["arms"]) &&
            isset($_POST["legs"]) &&
            isset($_POST["blood_pressure"]) &&
            isset($_POST["flashing_light"]) &&
            isset($_POST["loud_noises"]) &&
            isset($_POST["intense_visual"]) &&
            isset($_POST["heart_disease"]) &&
            isset($_POST["wheelchair"]) &&
            isset($_POST["intensity"]) &&
            isset($_POST["max_weight"]) &&
            isset($_POST["min_weight"]) &&
            isset($_POST["max_height"]) &&
            isset($_POST["min_height"]) &&
            isset($_POST["visual"]) &&
            isset($_POST["hearing"])
        ) {
            // Get form data for adding accessibility information
            $rideId = $_POST["ride_id"];
            $touch = $_POST["touch"];
            $taste = $_POST["taste"];
            $smell = $_POST["smell"];
            $sight = $_POST["sight"];
            $sound = $_POST["sound"];
            $pregnancy = ($_POST["pregnancy"] == '1') ? 1 : 0;
            $motion = ($_POST["motion"] == '1') ? 1 : 0;
            $arms = $_POST["arms"];
            $legs = $_POST["legs"];
            $blood_pressure = ($_POST["blood_pressure"] == '1') ? 1 : 0;
            $flashing_light = ($_POST["flashing_light"] == '1') ? 1 : 0;
            $loud_noises = ($_POST["loud_noises"] == '1') ? 1 : 0;
            $intense_visual = ($_POST["intense_visual"] == '1') ? 1 : 0;
            $wheelchair = ($_POST["wheelchair"] == '1') ? 1 : 0;
            $heart_disease = ($_POST["heart_disease"] == '1') ? 1 : 0;
            $intensity = $_POST["intensity"];
            $max_weight = $_POST["max_weight"];
            $min_weight = $_POST["min_weight"];
            $max_height = $_POST["max_height"];
            $min_height = $_POST["min_height"];
            $visual = $_POST["visual"];
            $hearing = $_POST["hearing"];

            // Add accessibility information to the database
            $databaseHandler->addAccessibilityInformation(
                $rideId,
                $sight,
                $smell,
                $sound,
                $taste,
                $touch,
                $pregnancy,
                $motion,
                $arms,
                $legs,
                $blood_pressure,
                $flashing_light,
                $loud_noises,
                $intense_visual,
                $wheelchair,
                $heart_disease,
                $intensity,
                $max_weight,
                $min_weight,
                $max_height,
                $min_height,
                $visual,
                $hearing
            );
        }
        $_SESSION['complete'] = "New Ride Added.";
    }

    // Determine current page and rows per page
    $currentPage = $_GET['page'] ?? 1;
    $rowsPerPage = $_GET['rows'] ?? 10;

    // Fetch total rows
    $totalRows = $databaseHandler->getTotalRows();

    // Fetch rides data
    $result = $databaseHandler->getRidesData($currentPage, $rowsPerPage);

    // Close database connection
    $databaseHandler->closeConnection();
    if (isset($_SESSION['complete'])) {
        echo '<strong><p class="text-success text-center mt-4">' . $_SESSION['complete'] . '</p></strong>';
    }
    if (isset($_SESSION['delete'])) {
        echo '<strong><p class="text-danger text-center mt-4">' . $_SESSION['delete'] . '</p></strong>';
    }
    ?>
    <div class="ride-table-container">
        <div class="d-flex justify-content-between align-items-center my-3">
            <h1 class="col">Ride Lists</h1>
            <button class="btn btn-primary add">Add Ride</button>
        </div>

        <table id="ridesTable" class="table table-striped">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th scope="col">Park</th>
                    <th scope="col">Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">Physical Requirement</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table Body -->
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>1</td>";
                        echo "<td>" . $row["ride_id"] . "</td>";
                        echo "<td>" . $row["ride_name"] . "</td>";
                        echo "<td>" . $row["ride_category"] . "</td>";
                        echo "<td>" . $row["ride_info"] . "</td>";
                        echo "<td>" . $row["physical_requirement"] . "</td>";
                        // Actions column with icons
                        echo "<td>
                        <div class='d-flex'>
                        <a href='#editRideModal' class='btn btn-primary mr-2 edit-btn' data-toggle='modal' data-ride-id='" . $row["ride_id"] . "' data-ride-name='" . $row["ride_name"] . "' data-ride-category='" . $row["ride_category"] . "' data-ride-info='" . $row["ride_info"] . "' data-physical-requirement='" . $row["physical_requirement"] . "'><i class='fas fa-edit'></i></a>
                        <a href='#deleteConfirmationModal' class='btn btn-danger delete-btn' data-toggle='modal' data-ride-id='" . $row["ride_id"] . "'><i class='fas fa-trash'></i></a>
                        </div>
                    </td>";

                    }
                } else {
                    echo "<tr><td colspan='7'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <ul class="pagination justify-content-center">
            <?php
            // Display pagination links
            $totalPages = ceil($totalRows / $rowsPerPage);
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<li class='page-item'><a class='page-link' href='?page=$i&rows=$rowsPerPage'>$i</a></li>";
            }
            ?>
        </ul>
    </div>

    <!-- Add Ride Modal -->
    <div class="modal fade" id="addRideModal" tabindex="-1" role="dialog" aria-labelledby="addRideModalLabel"
        aria-hidden="true">
        <!-- Modal content for adding a ride goes here -->
        <div class="modal-dialog draggable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRideModalLabel">Add Ride</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addRideForm" method="post">
                        <div class="form-group">
                            <label for="ride_id">Ride Number</label>
                            <input type="number" class="form-control" id="ride_id" name="ride_id" required>
                        </div>
                        <div class="form-group">
                            <label for="rideName">Ride Name</label>
                            <input type="text" class="form-control" id="rideName" name="rideName" required>
                        </div>
                        <div class="form-group">
                            <label for="rideCategory">Category</label>
                            <input type="text" class="form-control" id="rideCategory" name="rideCategory" required>
                        </div>
                        <div class="form-group">
                            <label for="ride_info">Description</label>
                            <input type="text" class="form-control" id="ride_info" name="ride_info" required>
                        </div>
                        <div class="form-group">
                            <label for="physical_requirement">Physical Requirement</label>
                            <textarea class="form-control" id="physical_requirement" name="physical_requirement"
                                rows="5" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Accessibility Information Modal -->
    <div class="modal fade" id="addAccessibilityModal" tabindex="-1" role="dialog"
        aria-labelledby="addAccessibilityModalLabel" aria-hidden="true">
        <div class="modal-dialog draggable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAccessibilityModalLabel">Add Accessibility</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addAccessibilityForm" method="post">
                        <div class="form-group">
                            <label for="touch">Touch</label>
                            <input type="number" class="form-control" id="touch" name="touch" required>
                        </div>
                        <div class="form-group">
                            <label for="taste">Taste</label>
                            <input type="number" class="form-control" id="taste" name="taste" required>
                        </div>
                        <div class="form-group">
                            <label for="touch">Smell</label>
                            <input type="number" class="form-control" id="smell" name="smell" required>
                        </div>
                        <div class="form-group">
                            <label for="sight">Sight</label>
                            <input type="number" class="form-control" id="sight" name="sight" required>
                        </div>
                        <div class="form-group">
                            <label for="sound">Sound</label>
                            <input type="number" class="form-control" id="sound" name="sound" required>
                        </div>
                        <div class="form-group">
                            <label for="pregnancy">Pregnancy</label>
                            <select class="form-control" id="pregnancy" name="pregnancy">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="motion">Motion Sickness</label>
                            <select class="form-control" id="motion" name="motion">
                                <option value="1">Yes</option>
                                <option value="0" selected>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="arms">Arms</label>
                            <select class="form-control" id="arms" name="arms">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2" selected>2</option> <!-- Default selected -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="legs">Legs</label>
                            <select class="form-control" id="legs" name="legs">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2" selected>2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="blood_pressure">High Blood Pressure</label>
                            <select class="form-control" id="blood_pressure" name="blood_pressure">
                                <option value="1">Yes</option>
                                <option value="0" selected>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="flashing_light">Flashing Light</label>
                            <select class="form-control" id="flashing_light" name="flashing_light">
                                <option value="1">Yes</option>
                                <option value="0" selected>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="loud_noises">Loud Noises</label>
                            <select class="form-control" id="loud_noises" name="loud_noises">
                                <option value="1">Yes</option>
                                <option value="0" selected>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="intense_visual">Intense Visual</label>
                            <select class="form-control" id="intense_visual" name="intense_visual">
                                <option value="1">Yes</option>
                                <option value="0" selected>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="wheelchair">Wheelchair</label>
                            <select class="form-control" id="wheelchair" name="wheelchair">
                                <option value="1">Yes</option>
                                <option value="0" selected>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="heart_disease">Heart Disease</label>
                            <select class="form-control" id="heart_disease" name="heart_disease">
                                <option value="1">Yes</option>
                                <option value="0" selected>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="intensity">Intensity</label>
                            <input type="text" class="form-control" id="intensity" name="intensity" required>
                        </div>
                        <div class="form-group">
                            <label for="max_weight">Maximum Weight (in lbs)</label>
                            <input type="text" class="form-control" id="max_weight" name="max_weight" required>
                        </div>
                        <div class="form-group">
                            <label for="min_weight">Minimum Weight (in lbs)</label>
                            <input type="number" class="form-control" id="min_weight" name="min_weight" required>
                        </div>
                        <div class="form-group">
                            <label for="max_height">Maximum Height (in inches)</label>
                            <input type="number" class="form-control" id="max_height" name="max_height" required>
                        </div>
                        <div class="form-group">
                            <label for="min_height">Minumum Height (in inches)</label>
                            <input type="number" class="form-control" id="min_height" name="min_height" required>
                        </div>
                        <div class="form-group">
                            <label for="visual">Vision Required</label>
                            <select class="form-control" id="visual" name="visual">
                                <option value="1">Yes</option>
                                <option value="0" selected>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hearing">Hearing Required</label>
                            <select class="form-control" id="hearing" name="hearing">
                                <option value="1">Yes</option>
                                <option value="0" selected>No</option>
                            </select>
                        </div>
                        <input type="hidden" id="ride_id" name="ride_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger showFirstModal" data-dismiss="modal">Cancel</button>
                    <button type="submit" form="addAccessibilityForm" class="btn btn-primary showFirstModal">Add
                        Accessibility</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Ride Modal -->
    <div class="modal fade" id="editRideModal" tabindex="-1" role="dialog" aria-labelledby="editRideModalLabel"
        aria-hidden="true">
        <!-- Modal content for editing a ride goes here -->
        <div class="modal-dialog draggable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRideModalLabel">Edit Ride Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="editRide.php" method="post">
                        <div class="form-group">

                            <label for="ride_id">Ride Number</label>
                            <input type="number" class="form-control" id="ride_id" name="ride_id" readonly>
                        </div>
                        <div class="form-group">
                            <label for="rideName">Ride Name</label>
                            <input type="text" class="form-control" id="rideName" name="rideName" required>
                        </div>
                        <div class="form-group">
                            <label for="rideCategory">Category</label>
                            <input type="text" class="form-control" id="rideCategory" name="rideCategory" required>
                        </div>
                        <div class="form-group">
                            <label for="ride_info">Description</label>
                            <input type="text" class="form-control" id="ride_info" name="ride_info" required>
                        </div>
                        <div class="form-group">
                            <label for="physical_requirement">Physical Requirement</label>
                            <textarea class="form-control" id="physical_requirement" name="physical_requirement"
                                rows="5" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button=>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this ride?
                    <input type="hidden" id="rideToDelete" value=""> <!-- Hidden input to store the ride ID -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <?php include 'footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>


        $(document).ready(function () {
            $(".add").click(function () {
                $("#addRideModal").modal("show");
            });

            // When the addRideModal is hidden
            $('#addRideModal').on('hidden.bs.modal', function (e) {
                // Reset the form
                $('#addRideForm')[0].reset();
            });

            $('#addAccessibilityModal').on('hidden.bs.modal', function (e) {
                // Reset the form
                $('#addRideModal').css('opacity', 1);
            });

            // When the "Next" button within the addRideModal is clicked
            $('#addRideForm').submit(function (e) {
                e.preventDefault(); // Prevent default form submission

                // Serialize form data
                var formData = $(this).serialize();

                // AJAX request to submit form data and handle response
                $.ajax({
                    type: "POST",
                    url: "admin_ride_list.php",
                    data: formData,
                    success: function (response) {
                        // Extract ride ID from the form data
                        var rideId = $('#ride_id').val();

                        // Set the ride ID in the accessibility information form
                        $('#addAccessibilityModal').find('#ride_id').val(rideId);

                        $('#addRideModal').css('opacity', 0);

                        // Show the second popup modal for adding accessibility information
                        $('#addAccessibilityModal').modal('show');
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        // Handle error if necessary
                    }
                });
            });
        });

        $('#editRideModal').on('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = $(event.relatedTarget);

            // Extract data attributes
            var rideId = button.data('ride-id');
            var rideName = button.data('ride-name');
            var rideCategory = button.data('ride-category');
            var rideInfo = button.data('ride-info');
            var physicalRequirement = button.data('physical-requirement');

            // Find the modal itself
            var modal = $(this);

            // Set values of input fields
            modal.find('#ride_id').val(rideId);
            modal.find('#rideName').val(rideName);
            modal.find('#rideCategory').val(rideCategory);
            modal.find('#ride_info').val(rideInfo);
            modal.find('#physical_requirement').val(physicalRequirement);
        });

        $('#deleteConfirmationModal').on('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = $(event.relatedTarget);

            // Extract ride ID from the button's data attribute
            var rideId = button.data('ride-id');

            // Store ride ID in the hidden input
            $(this).find('#rideToDelete').val(rideId);
        });

        $('#confirmDeleteBtn').on('click', function () {
            var rideId = $('#rideToDelete').val();  // Assuming rideToDelete holds the rideId

            // AJAX call to server-side PHP script
            $.ajax({
                type: "POST",
                url: "delete_ride.php",  // PHP script that will handle the deletion
                data: { rideId: rideId },
                success: function (response) {
                    console.log("Server responded: ", response);
                    window.location.href = "admin_ride_list.php";  // Redirect after action
                },
                error: function (xhr) {
                    console.error("An error occurred: ", xhr.statusText);
                }
            });
        });
    </script>
</body>

</html>

<?php
    unset($_SESSION['complete']);
    unset($_SESSION['delete']);
?>