<?php
header('Content-Type: application/json');

$host = '';
$dbname = '';
$user = '';
$pass = '';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $q = isset($_GET['q']) ? mb_strtolower(trim($_GET['q'])) : '';

    $categories = [
        1 => 'букети з троянд',
        2 => 'кущові троянди',
        3 => 'півоновидні троянди',
        4 => 'півонії',
        5 => 'весільні букети',
        6 => 'авторські букети',
        7 => 'моно букети',
        8 => 'ранулкулюс',
        9 => 'квіти в коробці',
        10 => 'тюльпани',
        11 => 'букет комплімент',
        12 => 'новорічні букети',
        14 => 'ароматичні свічки',
        15 => 'доповнення до букетів іграшки',
    ];

    $matchedCategoryIds = array_keys(array_filter($categories, function ($name) use ($q) {
        return mb_strpos(mb_strtolower($name), $q) !== false;
    }));

    $sql = "SELECT ID, name, image, category FROM products WHERE LOWER(name) LIKE ?";
    $params = ["%$q%"];

    if (!empty($matchedCategoryIds)) {
        $placeholders = implode(',', array_fill(0, count($matchedCategoryIds), '?'));
        $sql .= " OR category IN ($placeholders)";
        $params = array_merge($params, $matchedCategoryIds);
    }

    $sql .= " LIMIT 10";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as &$item) {
        $item['category_name'] = $categories[$item['category']] ?? 'Невідомо';
    }

    echo json_encode($results);
} catch (PDOException $e) {
    echo json_encode([]);
}

