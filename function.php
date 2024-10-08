<?php
class Ride
{
    function getRideDetails($id, $conn)
    {
        $query = "SELECT ride_id, ride_name, ride_info FROM Ride WHERE ride_id = $id";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
        echo "<b>$data[ride_name]</b><br/>" . htmlspecialchars($data["ride_info"]);
    }

    function searchRide($keyword, $id, $conn)
    {
        $query = "SELECT ride_id FROM Ride WHERE ride_id = ? OR ride_name LIKE ?";
        $statement = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($statement, "ss", $keyword, $likeKeyword);
        $likeKeyword = '%' . $keyword . '%';
        mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);
        if ($id == null) {
            if (mysqli_num_rows($result) == 0) {
                echo '<div class="overlay">
                        <div class="message-box">NO RIDE FOUND!</div>
                    </div>';
            }
        } else {
            $found = false;
            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
                    if ($data['ride_id'] == $id) {
                        $found = true;
                    }
                }
                if (!$found) {
                    echo 'not-searched';
                }
            }
        }
        mysqli_stmt_close($statement);
    }

    function searchRideList($keyword, $conn)
    {
        $queryAll = "SELECT ride_id, ride_name FROM Ride";
        $queryId = "SELECT ride_id, ride_name FROM Ride WHERE ride_id = ? OR ride_name LIKE ?";

        if ($keyword != null) {
            $statement = mysqli_prepare($conn, $queryId);
            mysqli_stmt_bind_param($statement, "ss", $keyword, $likeKeyword);
            $likeKeyword = '%' . $keyword . '%';
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);

            if (mysqli_num_rows($result) < 1) {
                $result = mysqli_query($conn, $queryAll);
            }
        } else {
            $result = mysqli_query($conn, $queryAll);
        }

        while ($data = mysqli_fetch_assoc($result)) {
            echo "<a href = 'ride_description.php?id=$data[ride_id]'><div class='ride mb-3 d-flex align-items-center'>
            <div><span class='ride-number'>$data[ride_id]</span></div>
            <div><span>$data[ride_name]</span></div>
        </div></a>";
        }
    }
}