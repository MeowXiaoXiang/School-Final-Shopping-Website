document.addEventListener('DOMContentLoaded', function() {
    // 獲取元素
    var loginTab = document.getElementById('login-tab');
    var registerTab = document.getElementById('register-tab');
    var loginButton = document.getElementById('loginButton');
    var registerButton = document.getElementById('registerButton');

    // 監聽 Tab 切換事件
    loginTab.addEventListener('click', function() {
        loginButton.style.display = '';
        registerButton.style.display = 'none';
    });

    registerTab.addEventListener('click', function() {
        loginButton.style.display = 'none';
        registerButton.style.display = '';
    });

    // 處理表單提交
    loginButton.addEventListener('click', handleLoginFormSubmit);
    registerButton.addEventListener('click', handleRegisterFormSubmit);
});

function handleLoginFormSubmit() {
    // 獲取用戶輸入的帳號和密碼
    var username = document.getElementById('loginUsername');
    var password = document.getElementById('loginPassword');

    // 發送登入請求
    fetch('auth/loginHandler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username: username.value, password: password.value })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('登入成功！');
            location.reload(); // 登入成功後重新載入頁面
        } else {
            alert('登入失敗：' + data.message);
            password.value = ''; // 清除密碼
        }
    });
}

function handleRegisterFormSubmit() {
    // 獲取用戶輸入的帳號和密碼
    var username = document.getElementById('registerUsername');
    var password = document.getElementById('registerPassword');
    var confirmPassword = document.getElementById('confirmPassword');

    // 驗證密碼和確認密碼是否一致
    if (password.value !== confirmPassword.value) {
        alert('密碼和確認密碼不一致！');
        return;
    }

    // 發送註冊請求
    fetch('auth/registerHandler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username: username.value, password: password.value })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('註冊成功！');
            username.value = ''; // 清除帳號
            password.value = ''; // 清除密碼
            confirmPassword.value = ''; // 清除確認密碼

            // 切換到登入介面
            document.getElementById('login-tab').click();
        } else {
            alert('註冊失敗：' + data.message);
            password.value = ''; // 清除密碼
            confirmPassword.value = ''; // 清除確認密碼
        }
    });
}