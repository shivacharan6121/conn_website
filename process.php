<?php
session_start();
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_type = $_POST['form_type'];
    
    switch ($form_type) {
        case 'add_part':
            $part_no = $conn->real_escape_string($_POST['part_name']);
            $quantity = (int)$_POST['conn_count'];
            
            // Check if part_no already exists
            $check_sql = "SELECT quantity FROM parts WHERE part_no = '$part_no'";
            $result = $conn->query($check_sql);
            
            if ($result->num_rows > 0) {
                $_SESSION['alert'] = [
                    'type' => 'error',
                    'message' => "Part number $part_no already exists!"
                ];
            } else {
                $sql = "INSERT INTO parts (part_no, quantity) VALUES ('$part_no', $quantity)";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['alert'] = [
                        'type' => 'success',
                        'message' => "New part $part_no added successfully with $quantity connectors!"
                    ];
                } else {
                    $_SESSION['alert'] = [
                        'type' => 'error',
                        'message' => "Error adding part: " . $conn->error
                    ];
                }
            }
            break;
            
        case 'add_conn':
            $part_no = $conn->real_escape_string($_POST['conn_name']);
            $add_quantity = (int)$_POST['pin_count'];
            
            // Check if part_no exists
            $check_sql = "SELECT quantity FROM parts WHERE part_no = '$part_no'";
            $result = $conn->query($check_sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $current_quantity = $row['quantity'];
                $new_quantity = $current_quantity + $add_quantity;
                
                $sql = "UPDATE parts SET quantity = $new_quantity WHERE part_no = '$part_no'";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['alert'] = [
                        'type' => 'success',
                        'message' => "Successfully added $add_quantity connectors to part $part_no\n\nPrevious quantity: $current_quantity\nNew quantity: $new_quantity"
                    ];
                } else {
                    $_SESSION['alert'] = [
                        'type' => 'error',
                        'message' => "Error adding connectors: " . $conn->error
                    ];
                }
            } else {
                $_SESSION['alert'] = [
                    'type' => 'warning',
                    'message' => "Part number does not exist! Please add the part first."
                ];
            }
            break;
            
        case 'required_conn':
            $part_no = $conn->real_escape_string($_POST['part_name']);
            $remove_quantity = (int)$_POST['req_conn'];
            
            // Check if part_no exists
            $check_sql = "SELECT quantity FROM parts WHERE part_no = '$part_no'";
            $result = $conn->query($check_sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $current_quantity = $row['quantity'];
                
                if ($remove_quantity > $current_quantity) {
                    $_SESSION['alert'] = [
                        'type' => 'warning',
                        'message' => "Insufficient connectors!\n\nAvailable: $current_quantity\nRequired: $remove_quantity\nShortage: " . ($remove_quantity - $current_quantity)
                    ];
                } else {
                    $new_quantity = $current_quantity - $remove_quantity;
                    $sql = "UPDATE parts SET quantity = $new_quantity WHERE part_no = '$part_no'";
                    if ($conn->query($sql) === TRUE) {
                        $_SESSION['alert'] = [
                            'type' => 'success',
                            'message' => "Successfully removed connectors from part $part_no\n\nPrevious quantity: $current_quantity\nRemoved: $remove_quantity\nRemaining: $new_quantity"
                        ];
                    } else {
                        $_SESSION['alert'] = [
                            'type' => 'error',
                            'message' => "Error removing connectors: " . $conn->error
                        ];
                    }
                }
            } else {
                $_SESSION['alert'] = [
                    'type' => 'warning',
                    'message' => "Part number does not exist!"
                ];
            }
            break;
    }
    
    header("Location: index.php");
    exit();
}

$conn->close();
?>
