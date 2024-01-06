<!doctype html>
<html lang="zh-tw">
<head>
    <?php
    session_start();
    include('includes/db.php');

    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);

    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="imgs/uchlogo.ico">
    <title>健行科技大學 - 購物車</title>
    <link href="./vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="./vendor/bootstrap/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">
</head>
<body>
    <?php
    include('includes/navbar.php');
    ?>
    <div class="container mt-4 main-content">
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-3">
                    <div class="card" id="product-<?php echo $product['id']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <p class="card-text">價格: <?php echo $product['price']; ?></p>
                            <div class="mb-3">
                                <label for="quantity-<?php echo $product['id']; ?>" class="form-label">數量:</label>
                                <input type="number" id="quantity-<?php echo $product['id']; ?>" class="form-control" min="1" max="99" value="1">
                            </div>
                            <button class="btn btn-primary add-to-cart">加入購物車</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="vendor/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/theme.js"></script>
    <script src="assets/auth.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 更新購物車的數量
            updateCartQuantity();

            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', event => {
                    const card = event.target.closest('.card');
                    const productId = card.id.split('-')[1];
                    const quantity = Number(document.querySelector(`#quantity-${productId}`).value);

                    fetch('includes/cart_func/add_to_cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: quantity,
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('產品已成功加入購物車！');
                            updateCartQuantity();
                        } else {
                            alert('加入購物車失敗，請稍後再試。');
                        }
                    });
                });
            });
        });
        
    function updateCartQuantity() {
        fetch('includes/cart_func/get_cart_quantity.php')
        .then(response => response.json())
        .then(data => {
            document.querySelector('#cart-quantity').textContent = data.quantity;
            updateCartDisplay();
        });
    }
    </script>
</body>
</html>