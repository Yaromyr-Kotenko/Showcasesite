<?php
session_start();
$host = '';
$dbname = '';
$user = '';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'], $_POST['field'], $_POST['value'])) {
    $id = $_POST['id'];
    $field = $_POST['field'];
    $value = $_POST['value'];

    $allowedFields = ['current_status', 'description'];

    if (in_array($field, $allowedFields)) {
        if ($field === "current_status") {
            $stmt = $pdo->prepare("UPDATE orders SET current_status = ?, time_status_changed = NOW() WHERE ID = ?");
            $success = $stmt->execute([$value, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE orders SET description = ? WHERE ID = ?");
            $success = $stmt->execute([$value, $id]);
        }

        if ($success) {
            echo json_encode([
                "status" => "success",
                "new_time" => date("Y-m-d H:i:s") 
            ]);
        } else {
            echo json_encode(["status" => "error"]);
        }
    } else {
        echo json_encode(["status" => "invalid_field"]);
    }
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    $stmt = $pdo->prepare("DELETE FROM orders WHERE ID = ?");
    $success = $stmt->execute([$id]);

    echo json_encode(["status" => $success ? "success" : "error"]);
    exit();
}


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'products';

if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    echo "<p>Товар удален!</p>";
}

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];
    
    $stmt = $pdo->prepare("INSERT INTO products (name, price, quantity, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $price, $quantity, $image]);
    echo "<p>Товар добавлен!</p>";
}

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt1 = $pdo->query("SELECT * FROM orders");
$orders = $stmt1->fetchAll(PDO::FETCH_ASSOC);
$dataJson = json_encode($orders);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ-панель</title>
    <style>
        body { 
    font-family: Arial, sans-serif; 
    background-color: #f4f4f4; 
    margin: 0; 
    padding: 0;
}

.container { 
    width: 700px; 
    margin: 20px auto; 
    background: white; 
    padding: 20px; 
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
    border-radius: 5px;
}

form { 
    display: flex; 
    flex-direction: column; 
    gap: 10px; 
}

table { 
    width: 100%; 
    border-collapse: collapse; 
    margin-top: 20px; 
    background: white; 
}

th, td { 
    padding: 10px; 
    border: 1px solid #ccc; 
    text-align: left; 
}

.button { 
    padding: 10px; 
    background: green; 
    color: white; 
    border: none; 
    cursor: pointer; 
    border-radius: 5px;
}

.delete { 
    background: red; 
}

.delete-button{ 
    padding: 10px; 
    background: green; 
    color: white; 
    border: none; 
    cursor: pointer; 
    border-radius: 5px;
    background: red; 
}

.tabs {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.tab {
    flex: 1;
    text-align: center;
    padding: 15px;
    font-weight: bold;
    text-decoration: none;
    background: #ddd;
    color: black;
    border-radius: 5px;
    transition: background 0.3s;
}

.tab:hover {
    background: #bbb;
}

.tab.active {
    background: #bbb;
}
        .block {
            display: flex;
            flex-direction: column;
            width: 95%;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            border-radius: 8px;
        }
        .block-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
        .block-content {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            gap: 10px;
        }
        .left-side {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .right-side {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .right-side textarea {
    width: 100%; 
    height: 80px; 
    resize: vertical; 
    overflow-wrap: break-word; 
    word-wrap: break-word;
    white-space: pre-wrap; 
    box-sizing: border-box;
}

        
    </style>
</head>
<body>
    <div class="container">
        <div class="tabs">
            <a href="?tab=products" class="tab" style="<?= ($tab == 'products') ? 'background: #bbb;' : 'background: #ddd;' ?>">Управління товарами</a>
            <a href="?tab=orders" class="tab" style="<?= ($tab == 'orders') ? 'background: #bbb;' : 'background: #ddd;' ?>">Управління замовленнями</a>
        </div>

        <?php if ($tab == 'products'): ?>
            <h1>Управління товарами</h1>

        <h2>Добавити товар</h2>
        <form action="admin.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Назва" required>
            <textarea name="description" placeholder="Опис"></textarea>
            <select name="category">
                <option value="1">букет з троянд</option>
                <option value="2">кущові троянди</option>
                <option value="3">півоновидні троянди</option>
                <option value="4">півонії</option>
                <option value="5">весільні букети</option>
                <option value="6">авторські букети</option>
                <option value="7">моно букети</option>
                <option value="8">ранулкулюс</option>
                <option value="9">квіти в коробці</option>
                <option value="10">тюльпани</option>
                <option value="11">букет комплімент</option>
                <option value="12">новорічний букет</option>
                <option value="14">аромо свічки</option>
                <option value="15">доповнення до букетів</option>
                
            </select>
            <input type="number" name="cost" placeholder="Ціна" step="0.01" required>
            <input type="file" name="image">
            <select name="page">
                <option value="catalog">Каталог</option>
                <option value="special">Головна</option>
            </select>
            <button type="submit" name="add_product" class="button">Добавити</button>
        </form>

        <h2>Список товарів</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Назва</th>
                <th>Категорія</th>
                <th>Ціна</th>
                <th>сторінка</th>
                <th>Дата</th>
                <th>Дії</th>
            </tr>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product["ID"] ?></td>
                    <td><?= htmlspecialchars($product["name"]) ?></td>
                    <td><?= htmlspecialchars($product["category"]) ?></td>
                    <td><?= $product["cost"] ?> грн</td>
                    <td><?= $product["page"] == "catalog" ? "Каталог" : "Головна" ?></td>
                    <td><?= $product["time"] ?></td>
                    <td>
                        <a href="?delete=<?= $product["ID"] ?>" class="button delete">Видалити</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php elseif ($tab == 'orders'): ?>
            <h2>Управління замовленнями</h2>
            <div id="container"></div>
            
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("container");

    function createBlock(item) {
        const block = document.createElement("div");
        block.className = "block";
        block.innerHTML = `
            <div class="block-header">ID: ${item.ID}</div>
            <div class="block-content">
                <div class="left-side">
                    <div>Ім'я: <br><strong>${item.name}</strong></div>
                    <div>Номер телефону: <br><strong>${item.contact}</strong></div>
                    <div>Час появи: <br>${item.time_created}</div>
                    <div>Статус: 
                        <input type="text" class="status-input" data-id="${item.ID}" value="${item.current_status}">
                    </div>
                    <div class="status-time">Час останньої зміни статуса: <br>${item.time_status_changed}</div>
                </div>
                <div class="right-side">
                    <textarea class="description-input" data-id="${item.ID}">${item.description}</textarea>
                </div>
            </div>
            <button class="delete-button" data-id="${item.ID}">Видалити</button>
        `;

        container.appendChild(block);
    }

    function updateData(id, field, value) {
        fetch("admin.php", { 
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `id=${id}&field=${field}&value=${encodeURIComponent(value)}`
        })
        .then(response => response.json())
        .then(data => {
            if (field === "current_status" && data.status === "success") {
                document.querySelector(`.status-input[data-id='${id}']`).closest(".block")
                    .querySelector(".status-time").innerHTML = `Час останньої зміни статуса: <br>${data.new_time}`;
            }
        })
        .catch(error => console.error("Помилка обновлення:", error));
    }

    function deleteOrder(id, button) {
        if (!confirm("Чи ви впевнені що хочете видалити замовлення?")) return;

        fetch("admin.php", { 
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `delete_id=${id}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                button.closest(".block").remove();
            } else {
                alert("Помилка при видаленні замовлення.");
            }
        })
        .catch(error => console.error("Помилка при видаленні:", error));
    }

    container.addEventListener("input", function (event) {
        if (event.target.classList.contains("status-input")) {
            updateData(event.target.dataset.id, "current_status", event.target.value);
        } else if (event.target.classList.contains("description-input")) {
            updateData(event.target.dataset.id, "description", event.target.value);
        }
    });

    container.addEventListener("click", function (event) {
        if (event.target.classList.contains("delete-button")) {
            deleteOrder(event.target.dataset.id, event.target);
        }
    });

    const data = <?php echo $dataJson; ?>;
    data.forEach(createBlock);
});

    </script>
        <?php endif; ?>
    </div>
</body>
</html>
