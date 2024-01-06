<nav class="navbar fixed-top navbar-expand-md navbar-light bg-light">
    <div class="container">
        <span class="navbar-brand">
            <img src="imgs/uchlogo_only.png" width="30" height="30" class="d-inline-block align-top">
        </span>
        <span id="navbarTitle">健行科技大學 - 購物車</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="切換導覽">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-md-auto"></ul> <!-- 導覽列的中間連結 -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link cart-link position-relative" data-bs-toggle="modal" data-bs-target="#cartModal">
                        <i class="bi bi-cart cart-icon"></i>
                        <span class="cart-quantity" id="cart-quantity">0</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <?php if (!isset($_SESSION['username'])): ?>
                        <!-- 未登入時，點擊連結會觸發模態框 -->
                        <a class="nav-link" href="#" id="loginRegisterLink" role="button" data-bs-toggle="modal" data-bs-target="#loginRegisterModal">
                            <svg id="registerIcon" xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64' stroke='currentColor' aria-hidden="true">
                                <g class='mectrl_stroke' stroke-width='1.9' fill='none'>
                                    <circle cx='32' cy='32' r='30.25'/><g transform='matrix(1.1 0 0 1.1 8.8 5.61)'><circle class='mectrl_stroke' cx='20' cy='16' r='7'/><path class='mectrl_stroke' d='M30 35h10m-5-5v10M30.833 32.09A11 11 0 009 34'/>
                                </g>
                            </svg>&nbsp;
                            <span>登入/註冊</span>
                        </a>
                    <?php else: ?>
                        <!-- 已登入時，點擊連結會顯示下拉菜單 -->
                        <a class="nav-link dropdown-toggle" href="#" id="loginRegisterLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                                $avatarPath = "userAvatar/{$_SESSION['userid']}.png";
                                if (!file_exists($avatarPath)) {
                                    $avatarPath = "userAvatar/{$_SESSION['userid']}.jpg";
                                    if (!file_exists($avatarPath)) {
                                        $avatarPath = '<svg id="defaultAvatarIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" stroke="currentColor" aria-hidden="true" width="100%" height="100%"><g class="mectrl_stroke" stroke-width="1.9" fill="none"><circle cx="32" cy="32" r="30.25"/><g transform="matrix(1.1 0 0 1.1 8.8 5.61)"><circle class="mectrl_stroke" cx="20" cy="16" r="7"/><path class="mectrl_stroke" d="M30.833 32.09A11 11 0 009 33"/></g></g></svg>';
                                    } else {
                                        $avatarPath = '<img id="userAvatar" src="' . $avatarPath . '">';
                                    }
                                } else {
                                    $avatarPath = '<img id="userAvatar" src="' . $avatarPath . '">';
                                }
                            ?>
                            <?php echo $avatarPath; ?>&nbsp;
                            <span><?php echo $_SESSION['username']; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="loginRegisterLink">
                            <div class="avatar-container">
                                <div class="avatar-wrapper">
                                    <?php echo str_replace('id="userAvatar"', 'class="dropdown-avatar"', $avatarPath); ?>
                                    <div class="avatar-overlay">
                                        <span>更換頭貼</span>
                                        <input type="file" id="avatarInput" accept="image/png, image/jpeg" style="display: none;">
                                    </div>
                                </div>
                            </div><br>
                            <li><p class="dropdown-header" style="text-align: center;"><?php echo $_SESSION['username']; ?></p>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="includes/logout.php">
                                <i class="bi bi-box-arrow-right"></i>&nbsp;
                                登出
                            </a></li>
                        </ul>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <button type="button" id="theme-switcher" class="nav-link" aria-label="切換主題">
                        <svg id="sun-icon" fill="none" stroke-width="2" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" height="1.5em" width="1.5em">
                            <circle cx="12" cy="12" r="5"></circle>
                            <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"></path>
                        </svg>
                        <svg id="moon-icon" fill="none" stroke-width="2" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" height="1.5em" width="1.5em" style="display: none;">
                            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                        </svg>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="footer bg-light text-dark fixed-bottom">
    <div class="container text-center py-2">Copyright © 2024 XiaoXiang_Meow</div>
</div>
<!-- 模態框 -->
<div class="modal fade" id="loginRegisterModal" tabindex="-1" aria-labelledby="loginRegisterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">登入</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">註冊</button>
                    </li>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="關閉"></button>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="myTabContent">
                    <!-- 登入表單 -->
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <form id="loginForm">
                            <div class="mb-3">
                                <label for="loginUsername" class="form-label">帳號</label>
                                <input type="text" class="form-control" id="loginUsername" required>
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">密碼</label>
                                <input type="password" class="form-control" id="loginPassword" required>
                            </div>
                        </form>
                    </div>
                    <!-- 註冊表單 -->
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form id="registerForm">
                            <div class="mb-3">
                                <label for="registerUsername" class="form-label">帳號</label>
                                <input type="text" class="form-control" id="registerUsername" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerPassword" class="form-label">密碼</label>
                                <input type="password" class="form-control" id="registerPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">確認密碼</label>
                                <input type="password" class="form-control" id="confirmPassword" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary btn-lg btn-block" id="loginButton">登入</button>
                <button type="button" class="btn btn-primary btn-lg btn-block" id="registerButton" style="display: none;">註冊</button>
            </div>
        </div>
    </div>
</div>
<!-- 購物車模態框 -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">購物車</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="cartModalBody">
                <!-- 購物車內容將在這裡動態生成 -->
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">產品名稱</th>
                            <th scope="col">數量</th>
                            <th scope="col">金額</th>
                            <th scope="col">操作</th>
                        </tr>
                    </thead>
                    <tbody id="cartItems">
                        <!-- 購物車項目將在這裡動態生成 -->
                    </tbody>
                </table>
                <div class="text-center">
                    <h5>總金額：<span id="totalAmount"></span></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var navbar = document.querySelector('.navbar');
    var mainContent = document.querySelector('.main-content');

    navbar.addEventListener('show.bs.collapse', function () {
        mainContent.classList.add('navbar-expanded');
    });

    navbar.addEventListener('hide.bs.collapse', function () {
        mainContent.classList.remove('navbar-expanded');
    });

    document.querySelector('.avatar-overlay').addEventListener('click', function() {
        document.getElementById('avatarInput').click();
    });

    document.getElementById('avatarInput').addEventListener('change', function() {
        var file = this.files[0];
        var formData = new FormData();
        formData.append('avatar', file);

        fetch('includes/upload_avatar.php', {
            method: 'POST',
            body: formData
        }).then(function(response) {
            if (response.ok) {
                location.reload(true);
            } else {
                alert('上傳失敗');
            }
        });
    });
    function updateCart() {
        fetch('includes/cart_func/get_cart.php')
        .then(response => response.json())
        .then(data => {
            let total = 0;
            let cartContent = '';
            let items = {};

            data.items.forEach(item => {
                if (items[item.id]) {
                    items[item.id].quantity += item.quantity;
                } else {
                    items[item.id] = item;
                }
            });

            Object.values(items).forEach(item => {
                total += item.price * item.quantity;
                cartContent += `
                    <tr>
                        <td>${item.name}</td>
                        <td>${item.quantity}</td>
                        <td>${item.price * item.quantity}</td>
                        <td><button class="btn btn-danger remove-from-cart" data-product-id="${item.id}">刪除</button></td>
                    </tr>
                `;
            });

            document.querySelector('#cartItems').innerHTML = cartContent;
            document.querySelector('#totalAmount').textContent = total;
            document.querySelectorAll('.remove-from-cart').forEach(button => {
                button.addEventListener('click', event => {
                    const productId = event.target.dataset.productId;

                    fetch('includes/cart_func/remove_from_cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            product_id: productId,
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateCart();
                            updateCartQuantity();
                        } else {
                            alert('刪除商品失敗，請稍後再試。');
                        }
                    });
                });
            });
        });
    }
    document.querySelector('#cartModal').addEventListener('show.bs.modal', updateCart);
});
</script>