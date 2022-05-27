<!-- header start -->
<header>
	<div class="header-top-furniture wrapper-padding-2 res-header-sm">
		<div class="container-fluid"style="background-color:#154A71;">
			<div class="header-bottom-wrapper" >
				<div class="logo-2 furniture-logo ptb-30">
					<a href="/">
						<img src="{{ asset('themes/ezone/assets/img/logo/BOOKU.png') }}" alt="">
					</a>
				</div>
				<div class="menu-style-2 furniture-menu menu-hover">
					<nav>
						<ul>
							<li><a href="http://127.0.0.1:8000/home"style="color:#fff;">Beranda</a>
						
							<li><a href="{{ url('products') }}" style="color:#fff;">Toko Buku</a>
								<div>
									
										
								</div>
							</li>
							<li><a href="http://127.0.0.1:8000/blog" style="color:#fff;">blog</a>
							</li>
							<li><a href="http://127.0.0.1:8000/contact"style="color:#fff;">Info Kontak</a></li>
						</ul>
					</nav>
				</div>
				@include('themes.ezone.partials.mini_cart')
			</div>
			<div class="row">
				<div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
					<div class="mobile-menu">
						<nav id="mobile-menu-active">
							<ul class="menu-overflow">
								<li><a href="http://127.0.0.1:8000/">HOME</a></li>
									
								<li><a href="http://127.0.0.1:8000/products">pages</a>
								</li>
								<li><a href="http://127.0.0.1:8000/products">blog</a>
								</li>
							
							
								<li><a href="http://127.0.0.1:8000/contact"> Contact  </a></li>
							</ul>
						</nav>							
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="header-bottom-furniture wrapper-padding-2 border-top-3" style="background-color:#c4ddfd;>
		<div class="container-fluid">
			<div class="furniture-bottom-wrapper">
				<div class="furniture-login">
					<ul>
						@guest
							<li style="color:#333">Get Access: <a href="{{ url('login') }}">Login</a></li>
							<li style="color:#333"><a href="{{ url('register') }}">Register</a></li>
						@else
							<li>Hello: <a href="{{ url('profile') }}" >{{ Auth::user()->first_name }}</a></li>
							<a href="{{ route('logout') }}"style="color:#333;"
								onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						@endguest
					</ul>
				</div>
				<div class="furniture-search">
					<form action="{{ url('products') }}" method="GET" >
						<input placeholder="Telusuri Buku . . ." type="text" name="q" value="{{ isset($q) ? $q : null }}">
						<button>
							<i class="ti-search"></i>
						</button>
					</form>
				</div>
				<div class="furniture-wishlist">
					<ul>
						<li><a href="{{ url('favorites') }}"><i class="ti-heart"></i> Favorites</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</header>
<!-- header end -->