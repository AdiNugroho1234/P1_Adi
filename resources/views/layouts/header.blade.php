  <header class="header navbar-area">
      <!-- Start Topbar -->
      <div class="topbar bg-light border-bottom py-2">
          <div class="container">
              <div class="row justify-content-end align-items-center">
                  <div class="col-auto">
                      <!-- Currency Selection -->
                      <div class="select-position me-3 d-inline-block">
                          <select id="currency-select" class="form-select form-select-sm">
                              <option value="usd" selected>$ USD</option>
                              <option value="eur">€ EURO</option>
                              <option value="cad">$ CAD</option>
                              <option value="inr">₹ INR</option>
                              <option value="cny">¥ CNY</option>
                              <option value="bdt">৳ BDT</option>
                          </select>
                      </div>
                      <!-- Language Selection -->
                      <div class="select-position d-inline-block">
                          <select id="language-select" class="form-select form-select-sm">
                              <option value="en" selected>English</option>
                              <option value="es">Español</option>
                              <option value="fil">Filipino</option>
                              <option value="fr">Français</option>
                              <option value="ar">العربية</option>
                              <option value="hi">हिन्दी</option>
                              <option value="bn">বাংলা</option>
                          </select>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- End Topbar -->

      <!-- Start Header Middle -->
      <div class="header-middle">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-lg-3 col-md-3 col-7">
                      <!-- Start Header Logo -->
                      <a class="navbar-brand" href="index.html">
                          <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="Logo">
                      </a>
                      <!-- End Header Logo -->
                  </div>
                  <div class="col-lg-5 col-md-7 d-xs-none">
                      <!-- Start Main Menu Search -->
                      <div class="main-menu-search">
                          <!-- navbar search start -->
                          <div class="navbar-search search-style-5">
                              <div class="search-select">
                                  <div class="select-position">
                                      <select id="select1">
                                          <option selected>All</option>
                                          <option value="1">option 01</option>
                                          <option value="2">option 02</option>
                                          <option value="3">option 03</option>
                                          <option value="4">option 04</option>
                                          <option value="5">option 05</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="search-input">
                                  <input type="text" placeholder="Search">
                              </div>
                              <div class="search-btn">
                                  <button><i class="lni lni-search-alt"></i></button>
                              </div>
                          </div>
                          <!-- navbar search Ends -->
                      </div>
                      <!-- End Main Menu Search -->
                  </div>
                  <div class="col-lg-4 col-md-2 col-5">
                      <div class="middle-right-area">
                          <div class="dropdown">
                              <button
                                  class="btn btn-outline-light d-flex align-items-center gap-2 rounded-pill px-3 py-2"
                                  id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="lni lni-user fs-5"></i>
                                  <span>{{ Auth::check() ? Auth::user()->name : 'Hotline' }}</span>
                                  <i class="lni lni-chevron-down ms-1"></i>
                              </button>

                              <div class="dropdown-menu dropdown-menu-end mt-2 shadow-sm border-0 rounded-3"
                                  aria-labelledby="dropdownMenuLink" style="min-width: 180px;">
                                  @if (Auth::check())
                                  <h6 class="dropdown-header text-muted">Akun Anda</h6>
                                  <a class="dropdown-item" href="{{route('profile')}}">
                                      <i class="lni lni-user me-2"></i> Profil
                                  </a>
                                  <div class="dropdown-divider"></div>
                                  <form method="POST" action="{{ route('logout') }}">
                                      @csrf
                                      <button type="submit" class="dropdown-item text-danger">
                                          <i class="lni lni-exit me-2"></i> Logout
                                      </button>
                                  </form>
                                  @else
                                  <a class="dropdown-item" href="{{ route('login') }}">
                                      <i class="lni lni-lock-alt me-2"></i> Login
                                  </a>
                                  <a class="dropdown-item" href="{{ route('register') }}">
                                      <i class="lni lni-user-plus me-2"></i> Register
                                  </a>
                                  @endif
                              </div>
                          </div>

                          <!-- Shopping Item -->

                          <div class="navbar-cart">
                              <div class="wishlist">
                                  <a href="javascript:void(0)">
                                      <i class="lni lni-heart"></i>
                                      <span class="total-items">0</span>
                                  </a>
                              </div>
                              <div class="cart-items">
                                  <a href="javascript:void(0)" class="main-btn">
                                      <i class="lni lni-cart"></i>
                                      <span class="total-items">{{ $totalCartItems }}</span>
                                  </a>
                                  <!-- Shopping Item -->
                                  <div class="shopping-item">
                                      <div class="dropdown-cart-header">
                                          <span>{{ $totalCartItems }} Items</span>
                                          <a>View Cart</a>
                                      </div>
                                      <ul class="shopping-list">
                                          @foreach ($cartItems as $item)
                                          <li>
                                              <a href="{{ route('cart.remove', $item->id) }}" onclick="return confirm('Remove item from cart?')" class="remove" title="Remove this item"><i
                                                      class="lni lni-close"></i></a>
                                              <div class="cart-img-head">
                                                  @if (!empty($item->photo))
                                                  <img src="{{ asset('storage/' . $item->photo) }}"
                                                      alt="{{ $item->nama_barang }}" class="rounded" style="width: 80px; height: auto;" alt="{{ $item->nama_barang }}">
                                                  @endif
                                              </div>

                                              <div class="content">
                                                  <h4><a href="{{ route('cart.index', $item->barang_id) }}">
                                                          {{ $item->nama_barang }}</a></h4>
                                                  <p class="quantity">{{ $item->quantity }}x - {{ $item->ukuran }} <span class="amount">Rp.{{ number_format($item->harga, 2, ',', '.') }}</span></p>
                                              </div>
                                          </li>
                                          @endforeach
                                      </ul>
                                      <div class="bottom">
                                          <div class="total">
                                              <span>Total</span>
                                              <span class="total-amount">Rp.{{ number_format($subtotal ?? 0, 0, ',', '.') }}</span>
                                          </div>

                                          <div class="button">
                                              <a href="{{ route('cart.index') }}" class="btn animate">Cart</a>
                                          </div>
                                      </div>
                                  </div>
                                  <!--/ End Shopping Item -->
                              </div>
                          </div>
                          <!--/ End Shopping Item -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
      </div>
      </div>
      <!-- End Header Middle -->
      <!-- Start Header Bottom -->
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-8 col-md-6 col-12">
                  <div class="nav-inner">
                      <!-- Start Mega Category Menu -->
                      <div class="mega-category-menu">
                          <span class="cat-button"><i class="lni lni-menu"></i>All Categories</span>
                          <ul class="sub-category">
                              <li><a href="product-grids.html">Electronics <i class="lni lni-chevron-right"></i></a>
                                  <ul class="inner-sub-category">
                                      <li><a href="product-grids.html">Digital Cameras</a></li>
                                      <li><a href="product-grids.html">Camcorders</a></li>
                                      <li><a href="product-grids.html">Camera Drones</a></li>
                                      <li><a href="product-grids.html">Smart Watches</a></li>
                                      <li><a href="product-grids.html">Headphones</a></li>
                                      <li><a href="product-grids.html">MP3 Players</a></li>
                                      <li><a href="product-grids.html">Microphones</a></li>
                                      <li><a href="product-grids.html">Chargers</a></li>
                                      <li><a href="product-grids.html">Batteries</a></li>
                                      <li><a href="product-grids.html">Cables & Adapters</a></li>
                                  </ul>
                              </li>
                              <li><a href="product-grids.html">accessories</a></li>
                              <li><a href="product-grids.html">Televisions</a></li>
                              <li><a href="product-grids.html">best selling</a></li>
                              <li><a href="product-grids.html">top 100 offer</a></li>
                              <li><a href="product-grids.html">sunglass</a></li>
                              <li><a href="product-grids.html">watch</a></li>
                              <li><a href="product-grids.html">man’s product</a></li>
                              <li><a href="product-grids.html">Home Audio & Theater</a></li>
                              <li><a href="product-grids.html">Computers & Tablets </a></li>
                              <li><a href="product-grids.html">Video Games </a></li>
                              <li><a href="product-grids.html">Home Appliances </a></li>
                          </ul>
                      </div>
                      <!-- End Mega Category Menu -->
                      <nav class="navbar navbar-expand-lg">
                          <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                              aria-expanded="false" aria-label="Toggle navigation">
                              <span class="toggler-icon"></span>
                              <span class="toggler-icon"></span>
                              <span class="toggler-icon"></span>
                          </button>

                          <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                              <ul id="nav" class="navbar-nav ms-auto">
                                  <li class="nav-item">
                                      <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('about') }}" class="nav-link">About Us</a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
                                  </li>
                              </ul>
                          </div>
                      </nav>

                  </div>
              </div>
              <div class="col-lg-4 col-md-6 col-12">
                  <!-- Start Nav Social -->
                  <div class="nav-social">
                      <h5 class="title">Follow Us:</h5>
                      <ul>
                          <li>
                              <a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                          </li>
                          <li>
                              <a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                          </li>
                          <li>
                              <a href="javascript:void(0)"><i class="lni lni-instagram"></i></a>
                          </li>
                          <li>
                              <a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                          </li>
                      </ul>
                  </div>
                  <!-- End Nav Social -->
              </div>
          </div>
      </div>
      <!-- End Header Bottom -->
  </header>