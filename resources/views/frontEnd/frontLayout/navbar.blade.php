<header id="header">
    <div class="container-fluid">
        <div class="row " style="background:#131921;padding:20px 0;color:#FFF;">   
            <div class="col-6 col-md-3 logo  mr-4 text-center align-self-center" style="line-height:0px;">       
                <!-- Uncomment below if you prefer to use an image logo -->
                <a href="{{ url('/') }}">
                <h1>YAVATMALKAR</h1>
                <p style="font-size:12px;">Our Digital Yawatmal</p>
                </a>
            </div>
            <div class="col-12 col-md-5 text-center align-self-center">
                <div class="input-group" style="width: 100%;margin-left:auto;"> 
                    <input type="text" class="form-control" placeholder="Search for the products, Services and More in Yavatmal" aria-label="Input group example" aria-describedby="btnGroupAddon2" >
                    <div class="input-group-prepend">
                        <div class="input-group-text" id="btnGroupAddon2"><i class='bx bx-search'></i></div>
                    </div>
                </div>
            </div>
            <nav class=" col-md-3 nav-menu d-none d-lg-block ml-auto pl-2 align-self-center ">
                <ul>
                    <li ><a href="{{ url('/') }}">Sign In</a></li>
                    <li><a href="#"><i class='bx bx-cart' style="font-size:20px;"></i>Cart</a></li>
                    <li><a href="#">Orders/Return</a></li>
                </ul>
            </nav>    
        </div>
    </div>
    <div class="container-fluid">
        <div class="row headBottomBar align-items-center">
            <div class="col-md-12 p-0">
            <header class="nav-header">
                <span class="logo">
                    <?php 
                        $categories = DB::table('categories')->where('status', 1)->get();
                    ?>
                    <select name="" id="category" class="form-control category">
                        <option value="">All Products & Services</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </span>
                <nav class="middle scroll" id="navbarDiv">
                <?php 
                    $subCategories = DB::table('sub_categories')->where('status', 1)->get();
                ?>
                    @foreach($subCategories as $subCategory)
                    <span class="item">{{ $subCategory->sub_category }}</span>
                    @endforeach
                </nav>
            </header>
            </div>
        </div>
    </div>
</header>