<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <!-- <i class="nav-icon fas fa-home"></i> -->
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="/category" class="nav-link">
       
        <p>Category</p>
    </a>
</li>
<li class="nav-item">
    <a href="/products" class="nav-link">
       
        <p>Product</p>
    </a>
</li>
<li class="nav-item">
    <a href="/orders" class="nav-link">
       
        <p>Orders</p>
    </a>
</li>
<li class="nav-item">
    <a href="/tables" class="nav-link">
       
        <p>Table Allocation</p>
    </a>
</li>
<li class="nav-item">
    <a href="/employees" class="nav-link">
       
        <p>Employee</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('logout') }}" class="nav-link">
       
        <p>Logout</p>
    </a>
</li>
