<?php

$host = '';
$dbname = '';
$user = '';
$pass = '';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $Name = htmlspecialchars($data['Name']);
    $phone = htmlspecialchars($data['phone']);
    $cart = $data['cart'];
    
    $to = "lafloreria.kiev@gmail.com"; 
    $subject = "Надійшло нове замовлення від $Name";
    $message = "Ім'я: $Name\n";
    $message .= "Телефон: $phone\n\n";
    $message .= "Зацікавлений в товарі:\n";
    $order_total = 0;
    $messagetosent = "";
    foreach ($cart as $item) {
        $itemName = $item['name'];
        $itemPrice = number_format(floatval($item['price']), 2, '.', '');
        $itemQuantity = intval($item['quantity']);
        $message .= "- $itemName: $itemQuantity шт. x $itemPrice грн. = " . ($itemQuantity * $itemPrice) . " грн.\n";
        $order_total += $itemQuantity * $itemPrice;
        $messagetosent .= "- $itemName: $itemQuantity шт. x $itemPrice грн. = " . ($itemQuantity * $itemPrice) . " грн.\n";
    }
    $message .= "Загалом: $order_total\n";
    $messagetosent .= "Загалом: $order_total\n";
    $headers = "From: no-reply@lafloreria.com\r\n";
    
    $current_status = "очікує на дзвінок";
    
    $stmt = $conn->prepare("INSERT INTO `orders` (`ID`, `contact`, `time_created`, `time_status_changed`, `name`, `current_status`, `description`) VALUES (NULL, ?, CURRENT_TIMESTAMP, NULL, ?, ?, ?);");
    $stmt->bind_param("ssss", $phone, $Name, $current_status, $messagetosent);
    
    if ($stmt->execute()) {
        
        if (mail($to, $subject, $message, $headers)) {
            echo "Ваше замовлення готове, ми вам згодом зателефонуємо";
        } else {
            echo "Помилка, будь ласка спробуйте ще раз";
        }
    } else {
        echo "Помилка збереження даних у базі даних. Будь ласка, спробуйте ще раз.";
    }

    $stmt->close();
}
$conn->close();
?>
