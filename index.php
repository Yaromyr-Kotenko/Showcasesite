<?php
$host = '';
$dbname = '';
$user = '';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка підключення до бази даних: " . $e->getMessage());
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE page = 'special' ORDER BY time DESC");
$stmt->execute();
$offers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>магазин квітів La Floreria</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
        }
        header {
            background: url(./png/main.jpg) no-repeat;
            /*просто змініть main.png на нове фото*/
            background-position: center center; 
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
            cover: змінити зображення так, щоб воно повністю зайняло простір рамки, зберігши оригінальні пропорції зображення, але так частина зображення може бути відрізана
            contain: змінює зображення так, щоб воно повністю помістилося в рамки, зберігши оригінальні пропорції зображення
            */
            color: #ffffff;
            padding: 185px 20px;
            text-align: center;
            position: relative;
        }
        header img {
            margin: 0;
            font-size: 2.5em;
            background: rgba(0, 0, 0, 0.75);
            display: inline-block;
            padding: 20px;
            border-radius: 10px;
            width: 14.5%;
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
            margin-left: 20px;
            display: flex;
            align-items: center;
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

.slider-container {
    position: relative;
    width: 70%;              
    max-width: 800px;         
    margin: 0 auto;           
    overflow: hidden;        
    margin-bottom: 40px;     
}

.slider {
    display: flex;            
    transition: transform 0.5s ease-in-out;  
    width: 100%;             
    height: 70%;             
    max-height: 700px;      
}

.slider .slide {
    min-width: 100%;     
    position: relative;
    overflow: hidden;       
}

.slider .slide img {
    width: 100%;             
    height: 100%;           
    object-fit: cover;        
    object-position: center;  
    display: block;         
}


.slider .slide .text-overlay {
    position: absolute;
    bottom: 20px;
    left: 20px;
    background: rgba(0, 0, 0, 0.5); 
    color: #fff;
    padding: 20px;
    border-radius: 5px;
    font-size: 24px; 
    font-weight: bold;
}


.slider-buttons {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%); 
}


.slider-buttons button {
    background-color: rgba(0, 0, 0, 0.5);
    border: none;
    color: white;
    padding: 8% 4%;
    cursor: pointer;
}


        .flower-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .flower-item {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
        }
        .flower-item img {
            max-width: 100%;
            border-radius: 10px;
        }
        .flower-item h3 {
            margin: 10px 0;
        }
        .search-dropdown {
        position: absolute;
        background: #333;
        color: #fff;
        width: 200px;
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #555;
        border-radius: 5px;
        display: none;
        z-index: 1000;
    }
    .search-dropdown a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: #fff;
    }
    .search-dropdown a:hover {
        background: #555;
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
    .button-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 40px; 
    margin-bottom: 60px;
}
    .gold-button {
    background-color: rgba(0, 0, 0, 0.3); 
    color: #FFD700; 
    border: 1px solid rgba(255, 215, 0, 0.6);
    padding: 12px 28px;
    font-size: 18px;
    font-weight: bold;
    border-radius: 10px;
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    cursor: pointer;
    transition: all 0.3s ease;
    text-shadow: 0 0 5px rgba(255, 215, 0, 0.3);
}

.gold-button:hover {
    background-color: rgba(255, 215, 0, 0.1);
    border-color: #FFD700;
    box-shadow: 0 0 15px rgba(255, 215, 0, 0.3);
}
.gold-button img {
    height: 100px;
    object-fit: contain;
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
        width: 100%;
    }
    .slider-container {
        width: 100%;
    }

    .slider .slide .text-overlay {
        font-size: 16px;
        padding: 10px;
    }

    .slider-buttons button {
        padding: 10px;
    }
    .gold-button img {
        height: 60px;
    }

    .gold-button {
        padding: 10px 20px;
        font-size: 14px;
    }
    .logo {
        display: none;
    }
    header img {
        width: 45%;
    }
}


        
    </style>
</head>
<body>
    <header>
        
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
        <div class="container">
            <h2>Наші кращі пропозиції</h2>
            <div class="slider-container">
                <div class="slider" id="slider">
                    <?php if (!empty($offers)): ?>
                        <?php foreach ($offers as $offer): ?>
                            <div class="slide">
                                <!--htmlspecialchars($offer['name'], ENT_QUOTES, 'UTF-8')-->
                                <a href="katalog.php?ids=<?= urlencode($offer['ID']) ?>"> 
                                    <img src="<?= htmlspecialchars($offer['image']) ?>" alt="<?= htmlspecialchars($offer['name']) ?>">
                                </a>
                                <div class="text-overlay"><?= htmlspecialchars($offer['name']) ?> - <?= $offer['cost'] ?> грн</div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Наразі немає спеціальних пропозицій.</p>
                    <?php endif; ?>
                </div>
                <div class="slider-buttons">
                    <button onclick="prevSlide()">&#10094;</button>
                    <button onclick="nextSlide()">&#10095;</button>
                </div>
            </div>
        </div>
        <div class="button-wrapper"><button class="gold-button" onclick="window.open('https://www.instagram.com/lafloreria.ua/')"><img src="./png/gold.png"></button></div>

    </main>
    <footer>
        &copy; 2024 La Floreria
    </footer>
    <script>

        function searchProducts() {
    let input = document.getElementById("search-input");
    let query = input.value.trim();
    let resultsContainer = document.getElementById("search-results");

    if (query.length < 2) {
        resultsContainer.style.display = "none";
        return;
    }

    fetch(`search.php?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            resultsContainer.innerHTML = "";
            if (data.length > 0) {
                data.forEach(item => {
                    let link = document.createElement("a");
                    link.href = `katalog.php?ids=${item.ID}`;
                    link.innerHTML = `<img src="${item.image}" style="width: 40px; height: 40px; margin-right: 10px;"> ${item.name}`;
                    resultsContainer.appendChild(link);
                });
                resultsContainer.style.display = "block";
            } else {
                resultsContainer.style.display = "none";
            }
        })
        .catch(error => console.error("Ошибка поиска:", error));
}

// Закрытие списка при клике вне его
document.addEventListener("click", function(event) {
    let resultsContainer = document.getElementById("search-results");
    let input = document.getElementById("search-input");
    if (!input.contains(event.target) && !resultsContainer.contains(event.target)) {
        resultsContainer.style.display = "none";
    }
});
        function showSlide(index) {
            const slides = document.querySelectorAll('.slider .slide');
            if (index >= slides.length) {
                currentSlide = 0;
            } else if (index < 0) {
                currentSlide = slides.length - 1;
            } else {
                currentSlide = index;
            }
            const offset = -currentSlide * 100;
            document.querySelector('.slider').style.transform = `translateX(${offset}%)`;
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        function updateCart() {
            const cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = '';
            let total = 0;
            cart.forEach((item, index) => {
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                cartItem.innerHTML = `
                    <span>${item.name} - ${item.price} грн.</span>
                    <button class="button button-dark" onclick="removeFromCart(${index})">Удалить</button>
                `;
                cartItems.appendChild(cartItem);
                total += item.price;
            });
            document.getElementById('total-price').innerText = total;
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCart();
        }

        function redirectToCheckout() {
            const query = cart.map(item => `item=${encodeURIComponent(JSON.stringify(item))}`).join('&');
            window.location.href = `checkout.html?${query}`;
        }
        
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

        showSlide(currentSlide);
    </script>
</body>
</html>
