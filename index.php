<?php
function filter_hotels($hotels, $filter)
{
    if ($filter === 'all') {
        return $hotels;
    }

    $filtered_hotels = [];

    foreach ($hotels as $hotel) {
        if (($filter === 'yes' && $hotel['parking']) || ($filter === 'no' && !$hotel['parking'])) {
            $filtered_hotels[] = $hotel;
        }
    }

    return $filtered_hotels;
}

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$filtered_hotels = filter_hotels($hotels, $filter);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootels</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">

        <!-- table -->
        <div class="table-responsive">

            <table class="table table-primary">

                <caption>List of Hotels here near!</caption>

                <thead>
                    <tr>
                        <th scope="col">Name:</th>
                        <th scope="col">Details:</th>
                        <th scope="col">Parking:</th>
                        <th scope="col">Vote:</th>
                        <th scope="col">City Center (km):</th>
                    </tr>
                </thead>

                <tbody>

                    <!-- loop through each filtered hotel -->
                    <?php foreach ($filtered_hotels as $hotel_array) { ?>
                        <tr>
                            <th scope="row"><?php echo $hotel_array['name']; ?></th>
                            <td><?php echo $hotel_array['description']; ?></td>
                            <td><?php echo boolval($hotel_array['parking']) ? 'Yes' : 'No'; ?></td>
                            <td><?php echo $hotel_array['vote']; ?></td>
                            <td><?php echo $hotel_array['distance_to_center']; ?></td>
                        </tr>
                    <?php } ?>

                </tbody>

            </table>

        </div>
    </div>

    <!-- form -->
    <form action="index.php" method="GET">
        <div class="mb-1 container">
            <label for="parking" class="form-label">Parking:</label>
            <select name="filter">
                <option value="all" <?php echo ($filter === 'all') ? 'selected' : ''; ?>>All</option>
                <option value="yes" <?php echo ($filter === 'yes') ? 'selected' : ''; ?>>Parking</option>
                <option value="no" <?php echo ($filter === 'no') ? 'selected' : ''; ?>>No Parking</option>
            </select>

            <br>
            <button type="submit" class="btn btn-primary">Submit!</button>
        </div>
    </form>
</body>

</html>
