<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-1">
        <a class="navbar-brand" href="#">Admin panel: </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('admin')}}">Home <span class="sr-only">{{__('Admin')}}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('admin/users')}}">{{__('Users')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('admin/orders')}}">{{__('Orders')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('admin/categories')}}">{{__('Categories')}}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        Products
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{url('admin/products')}}">{{__('All Products')}}</a>
                        <a class="dropdown-item" href="{{url('admin/products/create')}}">{{__('New Products')}}</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
