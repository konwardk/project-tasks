<?php

@include 'database.php';

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch products from the database
$query = "SELECT * FROM products LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}       
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);


// Fetch total number of products for pagination    
$totalQuery = "SELECT COUNT(*) as total FROM products";
$totalResult = mysqli_query($conn, $totalQuery);        
$totalRow = mysqli_fetch_assoc($totalResult);
$totalProducts = $totalRow['total'];    
$totalPages = ceil($totalProducts / $limit);
?>


<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <h1>Products</h1>
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p>Price: <?php echo htmlspecialchars($product['price']); ?> Rs</p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
</body>
</html>