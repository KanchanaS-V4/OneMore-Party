<?php
session_start();
require_once 'dbh.inc.php'; // Make sure this returns a valid mysqli $conn

if (!isset($_SESSION['user_email']) || $_SESSION['user_email'] !== 'admin@gmail.com') {
    header("Location: Login.php");
    exit();
}

// Fetch bookings
$bookings_sql = "SELECT * FROM bookings ORDER BY event_date DESC";
$bookings_result = $conn->query($bookings_sql);
if (!$bookings_result) {
    die("Failed to fetch bookings: " . $conn->error);
}

// Fetch contact messages
$contact_sql = "SELECT * FROM contact_messages ORDER BY submitted_at DESC";
$contact_result = $conn->query($contact_sql);
if (!$contact_result) {
    die("Failed to fetch contact messages: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Panel</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    header {
      background: #343a40;
      color: #fff;
      padding: 1rem 2rem;
      text-align: center;
      font-size: 1.8rem;
    }
    .container {
      max-width: 1100px;
      margin: 2rem auto;
      background: #fff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    h2 {
      border-bottom: 2px solid #007bff;
      padding-bottom: 0.5rem;
      margin-top: 2rem;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
      font-size: 1rem;
    }
    thead {
      background: #007bff;
      color: white;
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }
    tr:nth-child(even) {
      background: #f2f2f2;
    }
    tr:hover {
      background-color: #e9f5ff;
    }
    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }
      thead {
        display: none;
      }
      tr {
        margin-bottom: 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 1rem;
      }
      td {
        padding-left: 50%;
        position: relative;
      }
      td::before {
        position: absolute;
        left: 15px;
        width: 45%;
        font-weight: bold;
        content: attr(data-label);
      }
    }
  </style>
</head>
<body>

<header>Admin Panel</header>

<div class="container">
  <h2>Bookings Overview</h2>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Event Type</th>
        <th>Event Date</th>
        <th>Guests</th>
        <th>Notes</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($booking = $bookings_result->fetch_assoc()): ?>
      <tr>
        <td data-label="Name"><?php echo htmlspecialchars($booking['name']); ?></td>
        <td data-label="Email"><?php echo htmlspecialchars($booking['email']); ?></td>
        <td data-label="Phone"><?php echo htmlspecialchars($booking['phone']); ?></td>
        <td data-label="Event Type"><?php echo htmlspecialchars($booking['event_type']); ?></td>
        <td data-label="Event Date"><?php echo htmlspecialchars($booking['event_date']); ?></td>
        <td data-label="Guests"><?php echo htmlspecialchars($booking['guests']); ?></td>
        <td data-label="Notes"><?php echo htmlspecialchars($booking['notes']); ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

 <h2>Contact Messages</h2>
<table>
  <thead>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Message</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $contact_sql = "SELECT * FROM contact_messages ORDER BY id DESC";
    $contact_result = $conn->query($contact_sql);
    if ($contact_result && $contact_result->num_rows > 0):
      while ($row = $contact_result->fetch_assoc()):
    ?>
    <tr>
      <td data-label="First Name"><?php echo htmlspecialchars($row['first_name']); ?></td>
      <td data-label="Last Name"><?php echo htmlspecialchars($row['last_name']); ?></td>
      <td data-label="Email"><?php echo htmlspecialchars($row['email']); ?></td>
      <td data-label="Phone"><?php echo htmlspecialchars($row['phone']); ?></td>
      <td data-label="Message"><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
    </tr>
    <?php endwhile; else: ?>
    <tr><td colspan="5">No contact messages found.</td></tr>
    <?php endif; ?>
  </tbody>
</table>
</div>
</body>
</html>
