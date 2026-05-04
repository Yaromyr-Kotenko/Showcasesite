<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог квітів</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
        }
        header {
            background: url(./png/try1.jpg) no-repeat;
            /*просто змініть main.png на нове фото*/
            background-position: top center; 
            /*
            якщо ви хочете змінити позицію фотографії, то достатьно замінити background-position після двух крапок на те, що вам необхідно. по вертікалі top, center, bottom (верх, центр, низ відповідно) 
            і по горізонталі left, center, right (ліво, центр, вправо відповідно)
            наприклад: 
            "background-position: center center;" відцентровує рівно по центру
            або "background-position: top left;" зображення буде зміщено так, щоб повністю помістити верхний лівий угол в рамки, відрізавши усе що не поміститься
            або "background-position: bottom right;" зображення буде зміщено так, щоб повністю помістити нижній правий угол в рамки, відрізавши усе що не поміститься, тощо. 
            якщо необхідно більш точно помістити зображення, можно використати відсотки, де перший відсоток відображає зміщення фото на відповідний відсоток від верхнього лівого кута по вертикалі, а другий по горизонталі
            наприклад: 
            "background-position: 50% 50%;" відцентровує рівно по центру, як "background-position: center center;"
            або "background-position: 0% 0%;" зображення буде зміщено так, щоб повністю помістити верхний лівий угол в рамки, відрізавши усе що не поміститься, як "background-position: top left;"
            або "background-position: 33% right;" зображення буде зміщено так, щоб повністю помістити нижній праву границю в рамки, відрізавши верхню третину зображення,
            або "background-position: 66% 33%;" зображення буде зміщено так, щоб повністю помістити зображення, відрізавши 66% верху зображення і 33% лівої частини зображення, тощо.
            */
            background-size: cover;
            /*
            я би не рекомендував змінювати цей параметр, але все ж. можно використати "background-size: auto;", "background-size: cover;" і "background-size: contain;",
            де auto: вставити зображення з оригінальними розмірами зображення, навіть якщо воно значно менше, або занадто велике.
            cover: збільшити або зменшити зображення так, щоб зображення повністю помістилося в рамки, зберігши оригінальні пропорції зображення. може привести до того що деякі частини зображеня не помістяться
            contain: змінює зображення так, щоб воно повністю помістилося в рамки, змінюючи пропорції зображення
            */
            color: #ffffff;
            padding: 140px 20px;
            text-align: center;
            position: relative;
        }
        header h1 {
            margin: 0;
            font-size: 2.5em;
            background: rgba(0, 0, 0, 0.5);
            display: inline-block;
            padding: 20px;
            border-radius: 10px;
        }
        nav {
            background-color: #333333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            position: relative;
        }
        nav .nav-left {
            display: flex;
            align-items: center;
        }
        nav .logo img {
            height: 40px;
            margin-left: 20px;
        }
        nav .nav-links {
            display: flex;
            margin-left: 20px;
        }
        nav .nav-links a {
            color: #e0e0e0;
            margin: 0 15px;
            text-decoration: none;
            text-align: center;
        }
        nav .nav-links a:hover {
            text-decoration: underline;
        }
        nav .search-container {
            display: flex;
            align-items: center;
            margin-left: 20px;
        }
        nav .search-container input[type="text"] {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        nav .search-container button {
            padding: 5px 10px;
            margin-left: 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        nav .search-container button:hover {
            background-color: #45a049;
        }
        nav .cart-icon {
            margin-right: 20px;
        }
        nav .cart-icon img {
            height: 40px;
            cursor: pointer;
        }
        main {
            padding: 20px;
        }
        footer {
            background-color: #333333;
            color: #e0e0e0;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #45a049;
        }
        .button-dark {
            background-color: #3a3a3a;
            color: #e0e0e0;
        }
        .button-dark:hover {
            background-color: #555555;
        }
        .filters {
            margin-bottom: 20px;
            text-align: center;
        }
        .filters h2 {
            margin: 0;
            font-size: 1.5em;
            color: #e0e0e0;
        }
        .filters .categories {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .filters .category {
            width: 150px;
            cursor: pointer;
            border-radius: 10px;
            overflow: hidden;
        }
        .filters .category img {
            width: 100%;
            border-radius: 10px;
        }
        .category-link {
            display: block;
            text-decoration: none;
        }
        .flower-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .flower-item h3 {
            margin: 10px 0;
        }
        .section {
            padding: 20px 0;
        }
        .flower-item {
            cursor: pointer;
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            width: calc(30%);
            box-sizing: border-box;
            margin: 10px;
        }
        .flower-item img {
            max-width: 100%;
            border-radius: 10px;
        }
        .modal {
            display: none; /* Скрываем модальное окно по умолчанию */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7); /* Черный фон с прозрачностью */
            padding-top: 60px;
        }
        .modal-content {
            background-color: #1e1e1e;
            margin: 0% auto;
            padding: 10px;
            border: 1px solid #888;
            width: 40%; /* Установлено на 80% ширины экрана */
            height: 70%;
            border-radius: 10px;
            color: #e0e0e0;
        }
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: #ffffff;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-content img {
            width: 80%; 
            height: 75%; 
            display: block;
            margin: 0 auto;
            object-fit: contain; 
            object-position: top center;
        }
        .category-link {
            display: inline-block;
            margin: 5px;
            padding: 30px 20px;
            background-color: #1a1a1a; /* Тёмный фон */
            border: 2px solid #d4af37; /* Золотая обводка */
            color: #d4af37; /* Золотой текст */
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
            border-radius: 10px; /* Скруглённые углы */
            transition: background-color 0.3s, color 0.3s, transform 0.2s; /* Плавные анимации */
        }
        .category-link:hover {
            background-color: #d4af37; /* Золотой фон при наведении */
            color: #1a1a1a; /* Тёмный текст при наведении */
            transform: translateY(-5px); /* Лёгкий подъём при наведении */
        }
        .category img {
            width: 75px; 
            height: 125px; 
            object-fit: cover; 
            object-position: center;
            border-radius: 5px;
        }
        .category-link:active {
            transform: translateY(2px); /* Эффект нажатия */
        }
        .scroll-to-top {
            display: none; /* Изначально скрыта */
            position: fixed;
            bottom: 75px;
            right: 75px;
            z-index: 100;
            background-color: rgba(51, 51, 51, 0.6); /* Полупрозрачный фон */
            color: white;
            padding: 55px;
            border-radius: 50%; /* Круглая форма */
            text-align: center;
            font-size: 24px;
            cursor: pointer;
            transition: background-color 0.3s ease, opacity 0.3s ease;
            opacity: 0.7; /* Полупрозрачность кнопки */
        }
        .scroll-to-top:hover {
            background-color: rgba(51, 51, 51, 0.9); /* Меняется при наведении */
            opacity: 1; /* Полная видимость при наведении */
        }
        .suggestions-box {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: #1e1e1e;
            border: 1px solid #444;
            border-top: none;
            max-height: 300px;
            overflow-y: auto;
            z-index: 999;
        }

        .suggestion-item {
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #333;
            transition: background 0.2s;
            color: #e0e0e0;
        }


        .suggestion-item:hover {
            background-color: #333;
        }

        .suggestion-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            object-position: center;
            margin-right: 10px;
            border-radius: 5px;
            flex-shrink: 0;
        }

        .suggestions-box::-webkit-scrollbar {
            width: 8px;
        }

        .suggestions-box::-webkit-scrollbar-track {
            background: #1e1e1e;
        }

        .suggestions-box::-webkit-scrollbar-thumb {
        background-color: #555;
        border-radius: 10px;
    }

    .suggestions-box::-webkit-scrollbar-thumb:hover {
        background-color: #777;
    }

    .suggestions-box {
        scrollbar-width: thin;
        scrollbar-color: #555 #1e1e1e;
    }
@media (max-width: 768px) {
    header {
        padding: 80px 10px;
    }

    header h1 {
        font-size: 1.8em;
        padding: 10px;
    }

nav {
        flex-direction: column;
        align-items: flex-start;
    }

    nav .nav-left {
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
    }

    nav .nav-links {
        flex-direction: column;
        margin-left: 0;
        width: 100%;
    }

    nav .nav-links a {
        margin: 10px 0;
    }

    nav .search-container {
        width: 100%;
        margin: 10px 0;
    }

    nav .search-container input[type="text"] {
        width: 100%;
    }

    .cart-icon {
        align-self: center;
        margin-top: 10px;
    }
    .cart-icon img {
        height: 5%;
    }

    .flower-item {
        align-self: center;
        flex-direction: column;
        width: 95%;
        margin: 10px 0;
    }

    .filters .categories {
        flex-direction: column;
        align-items: center;
    }

    .filters .categories {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        padding: 0 10px;
    }

    .category-link {
        width: 84%;
        margin: 0;
        padding: 10px;
        font-size: 14px;
    }

    .modal-content {
        width: 90%;
        height: auto;
    }

    .scroll-to-top {
        bottom: 30px;
        right: 30px;
        padding: 20px;
        font-size: 30px;
    }
    .logo {
        display: none;
    }
}




    </style>
</head>
<body>
    <?php
        // Подключение к базе данных через PHP (добавляется серверная часть)
        // Подключаемся к базе данных через PDO
        $host = '';
        $dbname = ''; // Имя вашей базы данных
        $user = '';  // Логин
        $pass = '';  // Пароль

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
        $idg = isset($_GET['ids']) ? htmlspecialchars($_GET['ids'], ENT_QUOTES, 'UTF-8') : null;
    ?>
    <header>
        <h1>Каталог букетів</h1>
    </header>
    <nav>
        <div class="nav-left">
            <div class="logo">
                <img src="./png/Logo.png" alt="Логотип">
            </div>
            <div class="search-container">
                <div style="position: relative; width: 250px;">
                <input type="text" id="searchInput" placeholder="Пошук..." style="width: 100%;">
                <div id="suggestions" class="suggestions-box"></div>
            </div>
                <button onclick="startSearch()">Пошук</button>
            </div>
            <div class="nav-links">
                <a href="index.php">Головна</a>
                <a href="katalog.php">Каталог</a>
                <a href="about.html">Про нас</a>
                <a href="services.html">Послуги</a>
                <a href="contact.html">Контакти</a>
            </div>
        </div>
        <div class="cart-icon">
            <a href="cart.html">
                <img src="./png/korz.png" alt="Корзина">
            </a>
        </div>
    </nav>
    <main>
        <div class="scroll-to-top" id="scrollToTopBtn">↑</div>
        <div class="container">
            <div class="filters">
                <h2>Категорії</h2>
                <div class="categories">
                    <a href="#section-roses" class="category-link">
                        <div class="category">
                            <img src="./png/roses.jpg" alt="букет з троянд">
                            букет з троянд
                        </div>
                    </a>
                    <a href="#section-bushroses" class="category-link">
                        <div class="category">
                            <img src="./png/rosesbush.png" alt="кущові троянди">
                            кущові троянди
                        </div>
                    </a>
                    <a href="#section-peoniesroses" class="category-link">
                        <div class="category">
                            <img src="./png/pionesroses.jpg" alt="півоновидні троянди">
                            півоновидні троянди
                        </div>
                    </a>
                    <a href="#section-peonies" class="category-link">
                        <div class="category">
                            <img src="./png/pivonia.jpg" alt="півонії">
                            півонії
                        </div>
                    </a>
                    <a href="#section-wedding" class="category-link">
                        <div class="category">
                            <img src="./png/wedding.png" alt="весільні букети">
                            весільні букети
                        </div>
                    </a>
                    <a href="#section-Authorbouquet" class="category-link">
                        <div class="category">
                            <img src="./png/author.jpg" alt="Авторські букети">
                            Авторські букети
                        </div>
                    </a>
                    <a href="#section-monobouquet" class="category-link">
                        <div class="category">
                            <img src="./png/mono.jpg" alt="Моно букети">
                            Моно букети
                        </div>
                    </a>
                    <a href="#section-Ranulculus" class="category-link">
                        <div class="category">
                            <img src="./png/ranulkulus.png" alt="Ранункулюс">
                            Ранулкулюс
                        </div>
                    </a>
                    <a href="#section-box" class="category-link">
                        <div class="category">
                            <img src="./png/box.png" alt="Квіти в коробці">
                            Квіти в коробці
                        </div>
                    </a>
                    <a href="#section-tulips" class="category-link">
                        <div class="category">
                            <img src="./png/tulip.jpg" alt="Тюльпани">
                            Тюльпани
                        </div>
                    </a>
                    <a href="#section-compliment" class="category-link">
                        <div class="category">
                            <img src="./png/compliment.jpg" alt="Букет комплімент">
                            Букет комплімент
                        </div>
                    </a>
                    <a href="#section-newyear" class="category-link">
                        <div class="category">
                            <img src="./png/newyear.jpg" alt="Новий рік">
                            Новорічні букети
                        </div>
                    </a>
                    <a href="#section-soft" class="category-link">
                        <div class="category">
                            <img src="./png/plushie.png" alt="М'які букети">
                            М'які іграшки
                        </div>
                    </a>
                    <a href="#section-candles" class="category-link">
                        <div class="category">
                            <img src="./png/candle.png" alt="Аромо свічки">
                            Аромо свічки
                        </div>
                    </a>
                    <a href="#section-addons" class="category-link">
                        <div class="category">
                            <img src="./png/dop.png" alt="Доповнення до букетів">
                            Доповнення до букетів
                        </div>
                    </a>
                </div>
            </div>
            <?php
                // Отримання продуктів з датабази
                $stmt = $pdo->prepare("SELECT * FROM products ORDER BY time DESC");
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div id="section-roses" class="section">
                <h2>Букети з троянд</h2>
                <div class="flower-gallery">
                    
                    <?php
            foreach ($products as $product) {
                if ($product['category'] == '1') {
                    $find = $product['ID'];
                    $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                    $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                    $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                    $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                    echo '
                    <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                        <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                            <img src="' . $image . '" alt="' . $image . '">
                        </div>
                    <h3>' . $name . '</h3>
                    <p>Ціна: ' . $cost . ' грн.</p>
                    <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                    </div>
                    ';
                }
            }
        ?>
                </div>
            </div>
            <div id="section-bushroses" class="section">
                <h2>Кущові троянди</h2>
                <div class="flower-gallery">
                    <?php
                        foreach ($products as $product) {
                            if ($product['category'] == '2') {
                                $find = $product['ID'];
                                $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                                $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                                $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                                echo '
                                <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                                    <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                                        <img src="' . $image . '" alt="' . $image . '">
                                    </div>
                                <h3>' . $name . '</h3>
                                <p>Ціна: ' . $cost . ' грн.</p>
                                <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="section-peoniesroses" class="section">
                <h2>Півоновидні троянди</h2>
                <div class="flower-gallery">
                    <?php
                        foreach ($products as $product) {
                            if ($product['category'] == '3') {
                                $find = $product['ID'];
                                $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                                $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                                $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                                echo '
                                <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                                    <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                                        <img src="' . $image . '" alt="' . $image . '">
                                    </div>
                                <h3>' . $name . '</h3>
                                <p>Ціна: ' . $cost . ' грн.</p>
                                <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="section-peonies" class="section">
                <h2>Півонії</h2>
                <div class="flower-gallery">
                    <?php
                        foreach ($products as $product) {
                            if ($product['category'] == '4') {
                                $find = $product['ID'];
                                $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                                $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                                $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                                echo '
                                <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                                    <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                                        <img src="' . $image . '" alt="' . $image . '">
                                    </div>
                                <h3>' . $name . '</h3>
                                <p>Ціна: ' . $cost . ' грн.</p>
                                <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="section-wedding" class="section">
                <h2>Весільні букети</h2>
                <div class="flower-gallery">
                    <?php
                        foreach ($products as $product) {
                            if ($product['category'] == '5') {
                                $find = $product['ID'];
                                $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                                $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                                $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                                echo '
                                <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                                    <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                                        <img src="' . $image . '" alt="' . $image . '">
                                    </div>
                                <h3>' . $name . '</h3>
                                <p>Ціна: ' . $cost . ' грн.</p>
                                <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="section-Authorbouquet" class="section">
                <h2>Авторські букети</h2>
                <div class="flower-gallery">
                    <?php
                        foreach ($products as $product) {
                            if ($product['category'] == '6') {
                                $find = $product['ID'];
                                $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                                $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                                $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                                echo '
                                <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                                    <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                                        <img src="' . $image . '" alt="' . $image . '">
                                    </div>
                                <h3>' . $name . '</h3>
                                <p>Ціна: ' . $cost . ' грн.</p>
                                <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="section-monobouquet" class="section">
                <h2>Моно букети</h2>
                <div class="flower-gallery">
                    <?php
                        foreach ($products as $product) {
                            if ($product['category'] == '7') {
                                $find = $product['ID'];
                                $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                                $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                                $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                                echo '
                                <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                                    <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                                        <img src="' . $image . '" alt="' . $image . '">
                                    </div>
                                <h3>' . $name . '</h3>
                                <p>Ціна: ' . $cost . ' грн.</p>
                                <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="section-Ranulculus" class="section">
                <h2>Ранулкулюс</h2>
                <div class="flower-gallery">
                    <?php
                        foreach ($products as $product) {
                            if ($product['category'] == '8') {
                                $find = $product['ID'];
                                $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                                $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                                $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                                echo '
                                <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                                    <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                                        <img src="' . $image . '" alt="' . $image . '">
                                    </div>
                                <h3>' . $name . '</h3>
                                <p>Ціна: ' . $cost . ' грн.</p>
                                <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="section-box" class="section">
                <h2>Квіти в коробці</h2>
                <div class="flower-gallery">
                    <?php
                        foreach ($products as $product) {
                            if ($product['category'] == '9') {
                                $find = $product['ID'];
                                $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                                $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                                $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                                echo '
                                <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                                    <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                                        <img src="' . $image . '" alt="' . $image . '">
                                    </div>
                                <h3>' . $name . '</h3>
                                <p>Ціна: ' . $cost . ' грн.</p>
                                <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="section-tulips" class="section">
                <h2>Тюльпани</h2>
                <div class="flower-gallery">
                    <?php
                        foreach ($products as $product) {
                            if ($product['category'] == '10') {
                                $find = $product['ID'];
                                $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                                $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                                $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                                echo '
                                <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                                    <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                                        <img src="' . $image . '" alt="' . $image . '">
                                    </div>
                                <h3>' . $name . '</h3>
                                <p>Ціна: ' . $cost . ' грн.</p>
                                <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="section-compliment" class="section">
                <h2>Букет комплімент</h2>
                <div class="flower-gallery">
                    <?php
                        foreach ($products as $product) {
                            if ($product['category'] == '11') {
                                $find = $product['ID'];
                                $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                                $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                                $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                                echo '
                                <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                                    <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                                        <img src="' . $image . '" alt="' . $image . '">
                                    </div>
                                <h3>' . $name . '</h3>
                                <p>Ціна: ' . $cost . ' грн.</p>
                                <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="section-newyear" class="section">
                <h2>Новорічні букети</h2>
                <div class="flower-gallery">
                    <?php
                        foreach ($products as $product) {
                            if ($product['category'] == '12') {
                                $find = $product['ID'];
                                $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                                $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                                $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                                echo '
                                <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                                    <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                                        <img src="' . $image . '" alt="' . $image . '">
                                    </div>
                                <h3>' . $name . '</h3>
                                <p>Ціна: ' . $cost . ' грн.</p>
                                <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="section-candles" class="section">
                <h2>Ароматичні свічки</h2>
                <div class="flower-gallery">
                    <?php
                        foreach ($products as $product) {
                            if ($product['category'] == '14') {
                                $find = $product['ID'];
                                $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                                $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                                $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                                echo '
                                <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                                    <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                                        <img src="' . $image . '" alt="' . $image . '">
                                    </div>
                                <h3>' . $name . '</h3>
                                <p>Ціна: ' . $cost . ' грн.</p>
                                <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
            <div id="section-addons" class="section">
                <h2>Доповнення до букетів</h2>
                <div class="flower-gallery">
                    <?php
                        foreach ($products as $product) {
                            if ($product['category'] == '15') {
                                $find = $product['ID'];
                                $name = htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8');
                                $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8');
                                $image = htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8');
                                $cost = htmlspecialchars($product['cost'], ENT_QUOTES, 'UTF-8');
                                echo '
                                <div id="' . $find . '" class="flower-item" onclick="openModal(\'' . $name . '\', \'' . $description . '\', \'' . $image . '\', \'' . $cost . ' грн\')">
                                    <div class="image-container" style="width: 100%; height: 70%; overflow: hidden;">
                                        <img src="' . $image . '" alt="' . $image . '">
                                    </div>
                                <h3>' . $name . '</h3>
                                <p>Ціна: ' . $cost . ' грн.</p>
                                <button class="button button-dark" onclick="event.stopPropagation(); addToCart(\'' . $name . '\', ' . $cost . ', \'' . $image . '\')">Добавити до кошика</button>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
            
        </div>
    </main>
    <div id="flowerModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modal-title"></h2>
            <img id="modal-image" src="" alt="Изображение букета">
            <p id="modal-description"></p>
            <p id="modal-price"></p>
            <button class="button" onclick="addToCart(document.getElementById('modal-title').innerText, document.getElementById('modal-price').innerText, document.getElementById('modal-image').innerText)">добавити до кошика</button>

        </div>
    </div>
    <footer>
        &copy; 2024 La Floreria
    </footer>
    <script>
        const cart = [];

        function addToCart(name, price, image) {
    let cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];

    const existingItemIndex = cart.findIndex(item => item.name === name);

    if (existingItemIndex !== -1) {
        cart[existingItemIndex].quantity += 1;
    } else {
        cart.push({ name, price, image, quantity: 1 });
    }

    // Сохраняем корзину обратно в localStorage
    localStorage.setItem('cart', JSON.stringify(cart));

    alert('Товар добавлено до кошика');
    loadCart(); 
}


        function openModal(title, description, imageUrl, price) {
            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-description').innerText = description;
            document.getElementById('modal-image').src = imageUrl;
            document.getElementById('modal-price').innerText = price;
            document.getElementById('flowerModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('flowerModal').style.display = "none";
        }
        
        window.onclick = function(event) {
            const modal = document.getElementById('flowerModal');
            if (event.target === modal) {
                closeModal();
            }
        };

        window.onscroll = function() {
            var scrollToTopBtn = document.getElementById("scrollToTopBtn");
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
              scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        };

        document.getElementById("scrollToTopBtn").onclick = function() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        };
        

        <?php if (!empty($idg)): ?>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Параметр name: ' + '<?= urlencode(htmlspecialchars($idg, ENT_QUOTES, 'UTF-8')) ?>');
            var element = document.getElementById('<?= urlencode(htmlspecialchars($idg, ENT_QUOTES, 'UTF-8')) ?>');
            if (element) {
                console.log('Элемент найден!');
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            } else {
                console.log('Элемент не найден.');
            }
        });
<?php endif; ?>

    function startSearch() {
    const input = document.getElementById('searchInput');
    const query = input.value.trim();
    if (query.length < 2) {
        document.getElementById('suggestions').innerHTML = '<div class="suggestion-item">Введіть більше символів</div>';
        return;
    }

    fetch('search.php?q=' + encodeURIComponent(query))
        .then(response => response.json())
        .then(data => {
            const suggestionsBox = document.getElementById('suggestions');
            suggestionsBox.innerHTML = '';

            if (data.length === 0) {
                suggestionsBox.innerHTML = '<div class="suggestion-item">Нічого не знайдено</div>';
                return;
            }

            data.forEach(item => {
                const div = document.createElement('div');
                div.className = 'suggestion-item';
                div.onclick = () => {
                    window.location.href = 'katalog.php?ids=' + item.ID;
                };

                const img = document.createElement('img');
                img.src = item.image;
                img.alt = item.name;

                const text = document.createElement('span');
                text.textContent = item.name;
                text.style.flex = '1';

                div.appendChild(img);
                div.appendChild(text);
                suggestionsBox.appendChild(div);
            });
        });
}
    </script>
</body>
</html>
