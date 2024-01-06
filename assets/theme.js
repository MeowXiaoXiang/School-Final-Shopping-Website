window.addEventListener('DOMContentLoaded', (event) => {
    const themeSwitcher = document.getElementById('theme-switcher');

    // 從 localStorage 中讀取主題設定
    const storedTheme = localStorage.getItem('theme');
    if (storedTheme) {
        updateTheme(storedTheme);
    }

    themeSwitcher.addEventListener('click', function() {
        const currentTheme = document.body.classList.contains('light-mode') ? 'light-mode' : 'dark-mode';
        const newTheme = currentTheme === 'light-mode' ? 'dark-mode' : 'light-mode';

        updateTheme(newTheme);

        // 將新的主題設定儲存到 localStorage 中
        localStorage.setItem('theme', newTheme);
    });

    // 讀取 <title> 元素的文字並設定到 #navbarTitle 元素
    const titleText = document.querySelector('title').innerText;
    const navbarTitle = document.getElementById('navbarTitle');
    navbarTitle.innerText = titleText;
});

function updateTheme(theme) {
    const navbarClass = theme === 'light-mode' ? 'navbar-light bg-light' : 'navbar-dark bg-dark';
    const footerClass = theme === 'light-mode' ? 'bg-light text-dark' : 'bg-dark text-light';
    const modalContentClass = theme === 'light-mode' ? 'modal-content bg-light text-dark' : 'modal-content bg-dark text-light';
    const dropdownMenuClass = theme === 'light-mode' ? 'dropdown-menu bg-light text-dark' : 'dropdown-menu bg-dark text-light';
    const dropdownItemClass = theme === 'light-mode' ? 'dropdown-item text-dark' : 'dropdown-item text-light';
    const dropdownHeaderClass = theme === 'light-mode' ? 'dropdown-header text-dark' : 'dropdown-header text-light';
    const cardClass = theme === 'light-mode' ? 'card bg-light text-dark' : 'card bg-dark text-light';
    const inputClass = theme === 'light-mode' ? 'form-control theme light-mode' : 'form-control theme dark-mode';

    // 更新 body、navbar、footer、modal-content 的樣式
    document.body.className = 'theme ' + theme;
    document.querySelector('.navbar').className = 'navbar fixed-top navbar-expand-md ' + navbarClass;
    document.querySelector('.footer').className = 'footer fixed-bottom ' + footerClass;
    document.getElementById('sun-icon').style.display = theme === 'dark-mode' ? 'none' : 'block';
    document.getElementById('moon-icon').style.display = theme === 'dark-mode' ? 'block' : 'none';
    document.querySelector('.modal-content').className = modalContentClass;
    document.querySelector('#cartModal .modal-content').className = modalContentClass;
    // 更新下拉選單的樣式
    const dropdownMenus = document.querySelectorAll('.dropdown-menu');
    dropdownMenus.forEach(menu => menu.className = dropdownMenuClass);

    // 更新購物車模態框的樣式
    const modalContent = document.querySelector('#cartModal .modal-content');
    modalContent.className = modalContentClass;

    // 更新表格的樣式
    const table = modalContent.querySelector('table');
    const tableClass = theme === 'light-mode' ? 'table-light' : 'table-dark';
    table.className = `table text-center ${tableClass}`;

    // 更新產品卡片的樣式
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => card.className = cardClass);

    const quantityInputs = document.querySelectorAll('.form-control');
    quantityInputs.forEach(input => input.className = inputClass);

    // 更新下拉選單內部元素的樣式
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(item => {
        item.className = dropdownItemClass;
        // 如果是深色主題，將文字和 SVG 圖標的顏色設定為淺色
        if (theme === 'dark-mode') {
            item.style.color = 'white';
            const svg = item.querySelector('svg');
            if (svg) {
                svg.style.fill = 'white';
            }
        }
    });

    const dropdownHeaders = document.querySelectorAll('.dropdown-header');
    dropdownHeaders.forEach(header => header.className = dropdownHeaderClass);

    // 更新模態框中的 tab 和輸入框的樣式
    const modal = document.querySelector('#loginRegisterModal');
    const tabs = modal.querySelectorAll('.nav-link');
    const inputs = modal.querySelectorAll('.form-control');
    tabs.forEach(tab => tab.className = 'nav-link theme ' + (theme === 'light-mode' ? 'light-mode' : 'dark-mode'));
    inputs.forEach(input => input.className = 'form-control theme ' + (theme === 'light-mode' ? 'light-mode' : 'dark-mode'));
}

function updateCartDisplay() {
    const cartQuantityElement = document.getElementById('cart-quantity');
    const cartQuantity = parseInt(cartQuantityElement.textContent, 10);

    if (cartQuantity > 0) {
        cartQuantityElement.style.display = 'flex';
    } else {
        cartQuantityElement.style.display = 'none';
    }
}