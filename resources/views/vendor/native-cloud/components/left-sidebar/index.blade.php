<li class="nav-item">
    <a href="{{route('home')}}" class="nav-link"><i class="fa-solid fa-house-flag nav-icon"></i>
        <p>Dashboard</p></a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link"><i class="nav-icon fa fa-cogs"></i>
        <p>Settings<i class="right fas fa-angle-left"></i></p></a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('user_list')}}" class="nav-link">
                <i class="fa fa-user-circle nav-icon"></i>
                <p>Users</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('permission_list')}}" class="nav-link">
                <i class="fa-solid fa-shield-halved nav-icon"></i>
                <p>Permission</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="/product" class="nav-link"><i class="nav-icon fa fa-shopping-bag"></i>
        <p>Product</p></a>
</li>

<li class="nav-item">
    <a href="{{route('stock.index')}}" class="nav-link"><i class="nav-icon fa fa-line-chart"></i>
        <p>Stock</p></a>
</li>
<li class="nav-item">
    <a href="/sales" class="nav-link"><i class="nav-icon fa fa-shopping-bag"></i>
        <p>Sales</p></a>
</li>
<li class="nav-item">
    <a href="/bank" class="nav-link"><i class="nav-icon fa-solid fa-vault"></i>
        <p>Bank</p></a>
</li>


