<?php
include "config.php";
header("Content-Type: application/json");

$query = "
  SELECT DATE(created_at) AS order_date, SUM(total) AS total_sales
  FROM orders
  GROUP BY DATE(created_at)
  ORDER BY DATE(created_at) ASC
";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = [
    "date" => $row["order_date"],
    "sales" => (float)$row["total_sales"]
  ];
}

echo json_encode($data);
?>