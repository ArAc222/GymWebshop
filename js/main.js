document.addEventListener('DOMContentLoaded', () => {
    const userId = sessionStorage.getItem('user_id');
    const header = document.getElementById('header');
    let navContent = `
        <nav>
            <a href="index.html">Home</a>
            <a href="products.html">Products</a>`;
    if (userId) {
        navContent += `<a href="cart.html">Cart (<span id="cart-count">0</span>)</a>
                       <a href="profile.html">Profile</a>
                       <a href="#" id="logout">Log off</a>`;
    } else {
        navContent += `<a href="login.html">Login</a>
                       <a href="register.html">Register</a>`;
    }
    navContent += `</nav>`;
    header.innerHTML = navContent;

    if (userId) {
        const logoutLink = document.getElementById('logout');
        if (logoutLink) {
            logoutLink.addEventListener('click', (e) => {
                e.preventDefault();
                fetch('php/logout.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=logout',
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        sessionStorage.clear();
                        window.location.href = 'index.html';
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        }

        updateCartCount();
    }

    if (window.location.pathname.includes('products.html')) {
        setupProductsPage();
    }

    if (window.location.pathname.includes('cart.html')) {
        setupCartPage();
    }

    if (window.location.pathname.includes('profile.html')) {
        setupProfilePage();
    }
});

function updateCartCount() {
    const userId = sessionStorage.getItem('user_id');
    if (userId) {
        fetch(`php/cart.php?action=getCartCount&userId=${userId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const cartCountElement = document.getElementById('cart-count');
                    if (cartCountElement) {
                        cartCountElement.textContent = data.count;
                    }
                }
            })
            .catch(error => console.error('Failed to update cart count:', error));
    }
}

function setupProductsPage() {
    fetch('php/products.php?action=getProducts&page=1&itemsPerPage=20')
        .then(response => response.json())
        .then(data => {
            const productList = document.getElementById('product-list');
            productList.innerHTML = '';
            data.products.forEach(product => {
                const productItem = document.createElement('div');
                productItem.classList.add('product-item');
                productItem.innerHTML = `
                    <img src="${product.image}" alt="${product.name}" style="width:100px; height:100px;">
                    <h3>${product.name}</h3>
                    <p>${product.description}</p>
                    <p class="price">$${product.price}</p>
                    <button onclick="addToCart(${product.id}, '${product.name}', ${product.price})">Add to Cart</button>
                `;
                productList.appendChild(productItem);
            });

            setupPagination(data.totalPages);
        })
        .catch(error => console.error('Error loading products:', error));
}

function setupPagination(totalPages) {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';
    for (let i = 1; i <= totalPages; i++) {
        const pageLink = document.createElement('a');
        pageLink.href = '#';
        pageLink.textContent = i;
        pageLink.addEventListener('click', (e) => {
            e.preventDefault();
            loadProducts(i);
        });
        pagination.appendChild(pageLink);
    }
}

function loadProducts(page) {
    fetch(`php/products.php?action=getProducts&page=${page}&itemsPerPage=20`)
        .then(response => response.json())
        .then(data => {
            const productList = document.getElementById('product-list');
            productList.innerHTML = '';
            data.products.forEach(product => {
                const productItem = document.createElement('div');
                productItem.classList.add('product-item');
                productItem.innerHTML = `
                    <img src="${product.image}" alt="${product.name}" style="width:100px; height:100px;">
                    <h3>${product.name}</h3>
                    <p>${product.description}</p>
                    <p class="price">$${product.price}</p>
                    <button onclick="addToCart(${product.id}, '${product.name}', ${product.price})">Add to Cart</button>
                `;
                productList.appendChild(productItem);
            });
        })
        .catch(error => console.error('Error loading products:', error));
}

function addToCart(productId, productName, productPrice) {
    const userId = sessionStorage.getItem('user_id');
    if (!userId) {
        alert('You must be logged in to add items to the cart.');
        window.location.href = 'login.html';
        return;
    }

    fetch('php/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=addToCart&userId=${userId}&productId=${productId}&quantity=1`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(`${productName} added to cart.`);
            updateCartCount();
        } else {
            alert('Failed to add product to cart.');
        }
    })
    .catch(error => console.error('Error adding to cart:', error));
}

function setupCartPage() {
    const userId = sessionStorage.getItem('user_id');
    if (!userId) {
        alert('User not logged in!');
        window.location.href = 'login.html';
        return;
    }

    fetch(`php/cart.php?action=getCartItems&userId=${userId}`)
        .then(response => response.json())
        .then(data => {
            const cartItemsContainer = document.getElementById('cart-items');
            const cartTotalElement = document.getElementById('cart-total');
            cartItemsContainer.innerHTML = '';
            let total = 0;

            data.items.forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');
                cartItem.innerHTML = `
                    <img src="${item.image}" alt="${item.name}">
                    <h3>${item.name}</h3>
                    <p class="price">$${item.price}</p>
                    <input type="number" value="${item.quantity}" min="1" class="quantity" data-product-id="${item.id}">
                    <button class="remove-button" data-product-id="${item.id}">Remove</button>
                `;
                cartItemsContainer.appendChild(cartItem);
                total += item.price * item.quantity;
            });

            cartTotalElement.textContent = total.toFixed(2);
            bindCartEvents();
        })
        .catch(error => console.error('Error:', error));
}

function bindCartEvents() {
    const quantityInputs = document.querySelectorAll('.quantity');
    quantityInputs.forEach(input => {
        input.addEventListener('input', (e) => {
            const productId = e.target.getAttribute('data-product-id');
            const newQuantity = parseInt(e.target.value, 10);
            updateCartItemQuantity(productId, newQuantity);
        });
    });

    const removeButtons = document.querySelectorAll('.remove-button');
    removeButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const productId = e.target.getAttribute('data-product-id');
            removeFromCart(productId);
        });
    });
}

function updateCartItemQuantity(productId, quantity) {
    const userId = sessionStorage.getItem('user_id');
    fetch('php/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=updateCartItem&userId=${userId}&productId=${productId}&quantity=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            setupCartPage();
            updateCartCount();
        } else {
            alert(data.message);
        }
    });
}

function removeFromCart(productId) {
    const userId = sessionStorage.getItem('user_id');
    fetch('php/cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=removeFromCart&userId=${userId}&productId=${productId}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            setupCartPage();
            updateCartCount();
        } else {
            alert(data.message);
        }
    });
}

function setupProfilePage() {
    const userId = sessionStorage.getItem('user_id');
    if (!userId) {
        alert('User not logged in!');
        window.location.href = 'login.html';
        return;
    }

    fetch(`php/user.php?action=getUserProfile&userId=${userId}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('username').textContent = data.user.username;
                document.getElementById('email').textContent = data.user.email;
                document.getElementById('role').textContent = data.user.role;
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
}
