<?php
session_start();
require_once 'db_config.php';

// Handle search functionality
$search_query = '';
$searching = false; // Flag to check if searching

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = $conn->real_escape_string($_GET['search']);
    $searching = true;
}

// Fetch matching parts when searching, otherwise return an empty result
$sql = "SELECT * FROM part WHERE Nomenclature LIKE '%$search_query%'";

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Parts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .search-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-bar input[type="text"] {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .search-bar button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
        }

        .search-bar button:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        .no-results {
            text-align: center;
            color: #dc3545;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>LIST OF CONNECTORS</h1>

        <!-- Search Bar -->
        <div class="search-bar">
            <form action="view.php" method="GET">
                <input type="text" name="search" placeholder="Search by Part No" value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <!-- Display Records -->
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Serial No</th>
                        <th>Nomenclature</th>
                        <th>Make</th>
                        <th>Total Qty</th>
                        <th>Used Qty</th>
                        <th>Available Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $serial_no = 1;
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $serial_no++; ?></td>
                            <td><?php echo htmlspecialchars($row['Nomenclature']); ?></td>
                            <td><?php echo htmlspecialchars($row['make']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($row['usedqty']); ?></td>
                            <td><?php echo htmlspecialchars($row['availableqty']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-results">No matching records found.</div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
