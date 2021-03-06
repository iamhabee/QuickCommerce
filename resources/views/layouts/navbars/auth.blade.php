<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo-small.png">
            </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            {{ __('QCommerce') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <!-- <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                            {{ __('Laravel examples') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">{{ __('UP') }}</span>
                                <span class="sidebar-normal">{{ __(' User Profile ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> -->
            <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                <a href="{{ route('profile.edit') }}">
                    <!-- <span class="sidebar-mini-icon">{{ __('UP') }}</span> -->
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Profile') }}</p>
                    <!-- <span class="sidebar-normal">{{ __(' User Profile ') }}</span> -->
                </a>
            </li>
            <li class="{{ $elementActive == 'product' ? 'active' : '' }}">
                <a href="{{ route('product.index') }}">
                    <i class="nc-icon nc-layout-11"></i>
                    <p>{{ __('Products') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'order' ? 'active' : '' }}">
                <a href="{{ route('order.index') }}">
                    <i class="nc-icon nc-cart-simple"></i>
                    <p>{{ __('Order') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'brand' ? 'active' : '' }}">
                <a href="{{ route('brand.index') }}">
                    <i class="nc-icon nc-tag-content"></i>
                    <p>{{ __('Brands') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'tables' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'tables') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>{{ __('Category') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'blog' ? 'active' : '' }}">
                <a href="{{ route('blog.index') }}">
                    <i class="nc-icon nc-badge"></i>
                    <p>{{ __('Blog') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'transactions' ? 'active' : '' }}">
                <a href="{{ route('transaction.index') }}">
                    <i class="nc-icon nc-paper"></i>
                    <p>{{ __('Transactions') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'wishlist' ? 'active' : '' }}">
                <a href="{{ route('wishlist.index') }}">
                    <i class="nc-icon nc-basket"></i>
                    <p>{{ __('Wishlist') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>