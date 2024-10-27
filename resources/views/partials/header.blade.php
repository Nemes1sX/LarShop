<style>
  .header {
    background-color: grey;
    padding: 10px 0;
    color: white;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

.logo a {
    font-size: 24px;
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 20px;
}

.nav a {
    color: white;
    text-decoration: none;
    font-size: 18px;
}

.nav a:hover {
    text-decoration: underline;
}

.search-bar {
    display: flex;
    align-items: center;
}

.search-bar input {
    padding: 5px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    margin-right: 5px;
}

.search-bar button {
    padding: 6px 12px;
    background-color: #555;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.search-bar button:hover {
    background-color: #444;
}

.cart {
    position: relative;
}

.cart-icon img {
    width: 24px;
    height: 24px;
}

.cart-count {
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
    position: absolute;
    top: -10px;
    right: -10px;
}
</style>
<header class="header">
        <div class="container">
            <div class="logo">
                <a href="#">MyShop</a>
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <div class="search-bar">
                <input type="text" placeholder="Search products...">
                <button>Search</button>
            </div>
            <div class="cart">
                <a href="{{route('cart')}}" class="cart-icon">
                    <img src="{{ asset('img/cart-icon.png')}}" alt="Cart">
                    <span class="cart-count">{{$totalQuantity ?? 0}}</span>
                </a>
            </div>
        </div>
    </header>
    