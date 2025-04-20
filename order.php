<?php
$pdo = new PDO("mysql:host=localhost;dbname=bakery", "root", "");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
  $item = isset($_POST['item']) ? htmlspecialchars($_POST['item']) : '';
  $Quantity = isset($_POST['Quantity']) ? intval($_POST['Quantity']) : 0;
  $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

  if ($name && $item && $Quantity > 0) {
    $stmt = $pdo->prepare("INSERT INTO orders (name, item, Quantity, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $item, $Quantity, $message]);

    echo "Thank you, $name!<br>";
    echo "Order received: $Quantity × $item<br>";
    if (!empty($message)) {
      echo "Message: $message<br>";
    }
  } else {
    echo "Please fill in all required fields correctly.";
  }
} else {
  echo "Form not submitted.";
}
?>