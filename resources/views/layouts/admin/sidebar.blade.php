<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item {{Request::is('admin/dashboard') ? 'active':''}}">
      <a class="nav-link" href="{{url('admin/dashboard')}}">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title text-c">Dashboard</span>
      </a>
    </li>
    <li class="nav-item {{Request::is('admin/users') ? 'active':''}}">
      <a class="nav-link" href="{{url('admin/users')}}">
        <i class="mdi mdi-account-multiple-plus menu-icon"></i>
        <span class="menu-title">Users</span>
      </a>
    </li>
    <li class="nav-item {{Request::is('admin/categories') ? 'active':''}}">
      <a class="nav-link" href="{{url('admin/categories')}}">
        <i class="mdi mdi-view-list menu-icon"></i>
        <span class="menu-title">Category</span>
      </a>
    </li>
    <li class="nav-item {{Request::is('admin/items*') ? 'active':''}}">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-product" aria-expanded="{{Request::is('admin/items*') ? 'true':'false'}}" aria-controls="ui-product">
        <i class="mdi mdi-item-multiple menu-icon"></i>
        <span class="menu-title">Items</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse {{Request::is('admin/items*') ? 'show':''}}" id="ui-product">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link {{Request::is('admin/items*') || Request::is('admin/items/create*') || Request::is('admin/items/*/edit') ? 'active':''}}" href="{{url('admin/items')}}">All Items</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{Request::is('admin/orders') ? 'active':''}}">
      <a class="nav-link" href="{{url('admin/orders')}}">
        <i class="mdi mdi-car menu-icon"></i>
        <span class="menu-title">Orders</span>
      </a>
    </li>
    <li class="nav-item {{Request::is('admin/sites') ? 'active':''}}">
      <a class="nav-link" href="{{url('admin/sites')}}">
        <i class="mdi mdi-settings menu-icon"></i>
        <span class="menu-title">Site Settings</span>
      </a>
    </li>
  </ul>
</nav>