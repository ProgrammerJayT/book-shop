<div>
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="footer-heading">Book-Shop</h4>
                    <div class="footer-underline"></div>
                    <p>
                        Great space to browse for your next item
                    </p>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Quick Links</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2"><a href="" class="text-white">Home</a></div>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Shop Now</h4>
                    <div class="footer-underline"></div>
                    @foreach ($categories as $category)
                    <div class="mb-2"><a href="{{url('category/'.$category->category_id)}}" class="text-white">{{$category->name}}</a></div>
                    @endforeach
                    <div class="mb-2"><a href="{{url('new-arrivals')}}" class="text-white">New Arrivals Books</a></div>
                    <div class="mb-2"><a href="{{url('featured-items')}}" class="text-white">Featured Books</a></div>
                    <div class="mb-2"><a href="{{url('cart')}}" class="text-white">Cart</a></div>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Reach Us</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2">
                        <p>
                            <i class="fa fa-map-marker"></i> #444, some main road, some area, some street, bangalore, 560077
                        </p>
                    </div>
                    <div class="mb-2">
                        <a href="" class="text-white">
                            <i class="fa fa-phone"></i> +2768 0631 110
                        </a>
                    </div>
                    <div class="mb-2">
                        <a href="" class="text-white">
                            <i class="fa fa-envelope"></i> bs.bkshop@gmail.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class=""> &copy; 2023. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>
