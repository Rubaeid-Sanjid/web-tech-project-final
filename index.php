<?php
session_start();

// Database connection
$host = 'localhost'; // Update as needed
$dbname = 'ecommerce'; // Update as needed
$username = 'root'; // Update as needed
$password = ''; // Update as needed

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch products from the database
$query = "SELECT * FROM products"; // Assuming the table name is 'products'
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching products: " . mysqli_error($conn));
}

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/customer_utilities.css">
    <title>My Ecommerce Store</title>
</head>
<body>

    <header>
        <h1>Great Buy</h1>
        <nav>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="./views/login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="filter-sort">
            <h2>Filter and Sort</h2>
            <form id="price-filter-form">
                <label for="min-price">Min Price:</label>
                <input type="number" id="min-price" name="min-price" min="0"><br>
                <label for="max-price">Max Price:</label>
                <input type="number" id="max-price" name="max-price" min="0">
                <button type="submit">Filter</button>
            </form>
        </section>

        <section id="product-search">
            <h2>Product Search</h2>

            <form id="search-form" action="#" method="GET">
                <input type="text" id="search-input" name="search" placeholder="Search products...">
                <button type="submit">Search</button>
            </form>
        </section>

        <section id="shopping-cart" class="section-header">
            <h2><a href="./views/login.php">Shopping Cart</a></h2>
        </section>

        <section id="product-feedback" class="section-header">
            <h2><a href="./views/login.php">Product Reviews</a></h2>
        </section>

        <section id="previous-orders" class="section-header">
            <h2><a href="./views/login.php">Previous Orders</a></h2>
        </section>

        <section id="loyalty-programs" class="section-header">
            <h2><a href="./views/login.php">Loyalty Points</a></h2>
        </section>

        <?php foreach ($products as $product): ?>
            <section class="product">
                <h2><?= htmlspecialchars($product['name']) ?></h2>
                <p>Description: <?= htmlspecialchars($product['description']) ?></p>
                <p class="price">Price: $<?= htmlspecialchars($product['price']) ?></p>
                <p>Category: <?= htmlspecialchars($product['category']) ?></p>
                <p class="stock-quantity">Stock Quantity: <?= htmlspecialchars($product['stock_quantity']) ?></p>

                <form action="./views/login.php" method="post">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">
                    <input type="hidden" name="username" value="<?= $_SESSION["username"] ?? ''; ?>" id="username">
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                </form>
            </section>
        <?php endforeach; ?>
    </main>

    <footer>
        <p>&copy; 2025 Great Buy. All rights reserved.</p>
    </footer>

</body>

<script src="../JS/home_page.js"></script>

</html>
