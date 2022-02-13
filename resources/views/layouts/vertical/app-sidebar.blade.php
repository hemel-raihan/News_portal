				<!--APP-SIDEBAR-->
				<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
				<aside class="app-sidebar">
					<div class="side-header">
						<a class="header-brand1" href="{{ url('index') }}">
							<img src="{{ asset('frontend/images/browser_logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
							<img src="{{ asset('frontend/images/browser_logo.png') }}" class="header-brand-img toggle-logo" alt="logo">
							<img src="{{ asset('frontend/images/browser_logo.png') }}" class="header-brand-img light-logo" alt="logo">
							<img src="{{ asset('assets/frontend/logo.png') }}" class="header-brand-img light-logo1" alt="logo">
						</a><!-- LOGO -->
					</div>
					<ul class="side-menu">
						<li><h3>Main</h3></li>
						<li class="slide">
							<a class="side-menu__item"  data-bs-toggle="slide" href="{{route('admin.dashboard')}}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
						</li>
						<!-- <li><h3>Widgets & Maps</h3></li> -->
						<!-- <li>
							<a class="side-menu__item" href="{{ url('widgets') }}"><i class="side-menu__icon fe fe-grid"></i><span class="side-menu__label">Widgets</span></a>
						</li> -->

                        {{-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-layers"></i><span class="side-menu__label">Page Builder</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.custompages.create')}}" class="slide-item">Create Custom Page </a></li>
								<li><a href="{{route('admin.custompages.index')}}" class="slide-item">All Pages</a></li>
							</ul>
						</li> --}}

                        <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-layers"></i><span class="side-menu__label">Page Management</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.pages.create')}}" class="slide-item">Create New Page </a></li>
								<li><a href="{{route('admin.pages.index')}}" class="slide-item">All Pages</a></li>
							</ul>
						</li>

                        <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-layers"></i><span class="side-menu__label">Program Management</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
                                <li><a href="{{route('admin.programs.create')}}" class="slide-item">Create New Programs</a></li>
								<li><a href="{{route('admin.programs.index')}}" class="slide-item">All Programs</a></li>
								<li><a href="{{route('admin.programcategories.index')}}" class="slide-item">All Categories</a></li>
							</ul>
						</li>

                        {{-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-shopping-cart"></i><span class="side-menu__label">Product Management</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.products.create')}}" class="slide-item">Create New Product </a></li>
								<li><a href="{{route('admin.products.index')}}" class="slide-item">All Products</a></li>
								<li><a href="{{route('admin.productcategories.create')}}" class="slide-item">Add Category</a></li>
                                <li><a href="{{route('admin.productcategories.index')}}" class="slide-item">All Categories</a></li>
                                <li><a href="{{route('admin.brands.index')}}" class="slide-item">All Brands</a></li>
                                <li><a href="{{route('admin.attributes.index')}}" class="slide-item">All Attributes</a></li>
                                <li><a href="{{route('admin.colors.index')}}" class="slide-item">All Colors</a></li>
							</ul>
						</li> --}}

                        <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-globe"></i><span class="side-menu__label">News Management</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.posts.create')}}" class="slide-item">Create New News </a></li>
								<li><a href="{{route('admin.posts.index')}}" class="slide-item">All News</a></li>
								<li><a href="{{route('admin.categories.create')}}" class="slide-item">Add Category</a></li>
                                <li><a href="{{route('admin.categories.index')}}" class="slide-item">All Categories</a></li>
							</ul>
						</li>

                        <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-globe"></i><span class="side-menu__label">Add Management</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
                                <li><a href="{{route('admin.advertisements.create')}}" class="slide-item">New Advertisement</a></li>
								<li><a href="{{route('admin.advertisements.index')}}" class="slide-item">Advertisement List</a></li>
							</ul>
						</li>

                        {{-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-database"></i><span class="side-menu__label">Genaral Content</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.contentposts.create')}}" class="slide-item">Add New Content </a></li>
								<li><a href="{{route('admin.contentposts.index')}}" class="slide-item">All Contents</a></li>
								<li><a href="{{route('admin.contentcategories.create')}}" class="slide-item">Add Content Category</a></li>
                                <li><a href="{{route('admin.contentcategories.index')}}" class="slide-item">All Categories</a></li>
							</ul>
						</li> --}}

                        <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-user-plus"></i><span class="side-menu__label">Team Management</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.teamposts.create')}}" class="slide-item">Add New Team </a></li>
								<li><a href="{{route('admin.teamposts.index')}}" class="slide-item">All Teams</a></li>
								<li><a href="{{route('admin.teamcategories.create')}}" class="slide-item">Add Team Category</a></li>
                                <li><a href="{{route('admin.teamcategories.index')}}" class="slide-item">All Categories</a></li>
							</ul>
						</li>

                        {{-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-user-plus"></i><span class="side-menu__label">Marketing</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.flash-deals.index')}}" class="slide-item">FlashDeals</a></li>
							</ul>
						</li> --}}

                        {{-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-settings"></i><span class="side-menu__label">Service Management</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.services.create')}}" class="slide-item">Add New Service </a></li>
								<li><a href="{{route('admin.services.index')}}" class="slide-item">All Services</a></li>
								<li><a href="{{route('admin.servicecategories.create')}}" class="slide-item">Add Service Category</a></li>
                                <li><a href="{{route('admin.servicecategories.index')}}" class="slide-item">All Categories</a></li>
							</ul>
						</li> --}}

                        {{-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-briefcase"></i><span class="side-menu__label">Portfolio Management</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.portfolios.create')}}" class="slide-item">Add New Portfolio </a></li>
								<li><a href="{{route('admin.portfolios.index')}}" class="slide-item">All Portfolios</a></li>
								<li><a href="{{route('admin.portfoliocategories.create')}}" class="slide-item">Add Portfolio Category</a></li>
                                <li><a href="{{route('admin.portfoliocategories.index')}}" class="slide-item">All Categories</a></li>
							</ul>
						</li> --}}

                        {{-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-dollar-sign"></i><span class="side-menu__label">Pricing Tables</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.prices.create')}}" class="slide-item">Add New Price </a></li>
								<li><a href="{{route('admin.prices.index')}}" class="slide-item">All Prices</a></li>
								<li><a href="{{route('admin.pricecategories.create')}}" class="slide-item">Add Price Category</a></li>
                                <li><a href="{{route('admin.pricecategories.index')}}" class="slide-item">All Categories</a></li>
							</ul>
						</li> --}}

                        <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-align-justify"></i><span class="side-menu__label">Sidebar</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.sidebars.create')}}" class="slide-item">Create New Sidebar </a></li>
								<li><a href="{{route('admin.sidebars.index')}}" class="slide-item">All Sidebars</a></li>
							</ul>
						</li>

						{{-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-bell"></i><span class="side-menu__label">Notice</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.notices.create')}}" class="slide-item">Create New Notice </a></li>
								<li><a href="{{route('admin.notices.index')}}" class="slide-item">All Notice</a></li>
							</ul>
						</li>

						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-alert-triangle"></i><span class="side-menu__label">Hot Links</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.links.create')}}" class="slide-item">Create Hot Link </a></li>
								<li><a href="{{route('admin.links.index')}}" class="slide-item">All Links</a></li>
							</ul>
						</li> --}}

                        <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-align-left"></i><span class="side-menu__label">Front Menu</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.frontmenus.create')}}" class="slide-item">Create New Menu </a></li>
								<li><a href="{{route('admin.frontmenus.index')}}" class="slide-item">All Menus</a></li>
							</ul>
						</li>

						{{-- Slide + Slider--}}
						{{-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-airplay"></i><span class="side-menu__label">Slider</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.slides.create') }}" class="slide-item"> Create Slide</a></li>
								<li><a href="{{ route('admin.slides.index') }}" class="slide-item"> All Slide</a></li>
								<li><a href="{{ route('admin.sliders.create') }}" class="slide-item"> Create Slider</a></li>
								<li><a href="{{ route('admin.sliders.index') }}" class="slide-item">All Slider</a></li>
							</ul>
						</li> --}}

                        {{-- <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-video"></i><span class="side-menu__label">Video</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.videos.create') }}" class="slide-item"> Create Video</a></li>
								<li><a href="{{ route('admin.videos.index') }}" class="slide-item"> All Videos</a></li>
							</ul>
						</li> --}}

						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-user"></i><span class="side-menu__label">User Management</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ route('admin.users.create') }}" class="slide-item">Create User </a></li>
								<li><a href="{{ route('admin.users.index') }}" class="slide-item">All Userlist</a></li>
								<li><a href="{{ route('admin.roles.index') }}" class="slide-item">Role Management</a></li>
                                <li><a href="{{ route('admin.contact.index') }}" class="slide-item">Customer message List</a></li>
							</ul>
						</li>

                        <li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-settings"></i><span class="side-menu__label">Appearance Setting</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{route('admin.navbar.settings')}}" class="slide-item">Navbar Setting</a></li>
							</ul>
						</li>

						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-settings"></i><span class="side-menu__label">General Setting</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
                                <li><a href="{{route('admin.taxes.index')}}" class="slide-item">Vat & Tax</a></li>
								<li><a href="{{route('admin.settings')}}" class="slide-item">Site Setting</a></li>
                                <li><a href="{{route('admin.mail.settings')}}" class="slide-item">SMTP Setting</a></li>
							</ul>
						</li>

						<!-- <li><h3>Elements</h3></li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-database"></i><span class="side-menu__label">Components</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ url('cards') }}" class="slide-item"> Cards design</a></li>
								<li><a href="{{ url('calendar') }}" class="slide-item"> Default calendar</a></li>
								<li><a href="{{ url('calendar2') }}" class="slide-item"> Full calendar</a></li>
								<li><a href="{{ url('chat') }}" class="slide-item"> Default Chat</a></li>
								<li><a href="{{ url('notify') }}" class="slide-item"> Notifications</a></li>
								<li><a href="{{ url('sweetalert') }}" class="slide-item"> Sweet alerts</a></li>
								<li><a href="{{ url('rangeslider') }}" class="slide-item"> Range slider</a></li>
								<li><a href="{{ url('scroll') }}" class="slide-item"> Content Scroll bar</a></li>
								<li><a href="{{ url('loaders') }}" class="slide-item"> Loaders</a></li>
								<li><a href="{{ url('counters') }}" class="slide-item"> Counters</a></li>
								<li><a href="{{ url('rating') }}" class="slide-item"> Rating</a></li>
								<li><a href="{{ url('timeline') }}" class="slide-item"> Timeline</a></li>
								<li><a href="{{ url('treeview') }}" class="slide-item"> Treeview</a></li>
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-package"></i><span class="side-menu__label">Elements</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ url('alerts') }}" class="slide-item"> Alerts</a></li>
								<li><a href="{{ url('buttons') }}" class="slide-item"> Buttons</a></li>
								<li><a href="{{ url('colors') }}" class="slide-item"> Colors</a></li>
								<li><a href="{{ url('avatarsquare') }}" class="slide-item"> Avatar-Square</a></li>
								<li><a href="{{ url('avatar-round') }}" class="slide-item"> Avatar-Rounded</a></li>
								<li><a href="{{ url('avatar-radius') }}" class="slide-item"> Avatar-Radius</a></li>
								<li><a href="{{ url('dropdown') }}" class="slide-item"> Drop downs</a></li>
								<li><a href="{{ url('listpage') }}" class="slide-item"> List</a></li>
								<li><a href="{{ url('tags') }}" class="slide-item"> Tags</a></li>
								<li><a href="{{ url('pagination') }}" class="slide-item"> Pagination</a></li>
								<li><a href="{{ url('navigation') }}" class="slide-item"> Navigation</a></li>
								<li><a href="{{ url('typography') }}" class="slide-item"> Typography</a></li>
								<li><a href="{{ url('breadcrumbs') }}" class="slide-item"> Breadcrumbs</a></li>
								<li><a href="{{ url('badge') }}" class="slide-item"> Badges</a></li>
								<li><a href="{{ url('panels') }}" class="slide-item"> Panels</a></li>
								<li><a href="{{ url('thumbnails') }}" class="slide-item"> Thumbnails</a></li>
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-file"></i><span class="side-menu__label">Advanced Elements</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ url('mediaobject') }}" class="slide-item"> Media Object</a></li>
								<li><a href="{{ url('accordion') }}" class="slide-item"> Accordions</a></li>
								<li><a href="{{ url('tabs') }}" class="slide-item"> Tabs</a></li>
								<li><a href="{{ url('chart') }}" class="slide-item"> Charts</a></li>
								<li><a href="{{ url('modal') }}" class="slide-item"> Modal</a></li>
								<li><a href="{{ url('tooltipandpopover') }}" class="slide-item"> Tooltip and popover</a></li>
								<li><a href="{{ url('progress') }}" class="slide-item"> Progress</a></li>
								<li><a href="{{ url('carousel') }}" class="slide-item"> Carousels</a></li>
								<li><a href="{{ url('headers') }}" class="slide-item"> Headers</a></li>
								<li><a href="{{ url('footers') }}" class="slide-item"> Footers</a></li>
								<li><a href="{{ url('users-list') }}" class="slide-item"> User List</a></li>
								<li><a href="{{ url('search') }}" class="slide-item">Search</a></li>
								<li><a href="{{ url('crypto-currencies') }}" class="slide-item"> Crypto-currencies</a></li>
							</ul>
						</li>
						<li><h3>Charts & Tables</h3></li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-pie-chart"></i><span class="side-menu__label">Charts</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ url('chart-chartist') }}" class="slide-item">Chart Js</a></li>
								<li><a href="{{ url('chart-flot') }}" class="slide-item"> Flot Charts</a></li>
								<li><a href="{{ url('chart-echart') }}" class="slide-item"> ECharts</a></li>
								<li><a href="{{ url('chart-morris') }}" class="slide-item"> Morris Charts</a></li>
								<li><a href="{{ url('chart-nvd3') }}" class="slide-item"> Nvd3 Charts</a></li>
								<li><a href="{{ url('charts') }}" class="slide-item"> C3 Bar Charts</a></li>
								<li><a href="{{ url('chart-line') }}" class="slide-item"> C3 Line Charts</a></li>
								<li><a href="{{ url('chart-donut') }}" class="slide-item"> C3 Donut Charts</a></li>
								<li><a href="{{ url('chart-pie') }}" class="slide-item"> C3 Pie charts</a></li>
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-clipboard"></i><span class="side-menu__label">Tables</span><span class="badge bg-secondary side-badge">2</span></a>
							<ul class="slide-menu">
								<li><a href="{{ url('tables') }}" class="slide-item">Default table</a></li>
								<li><a href="{{ url('datatable') }}" class="slide-item"> Data Tables</a></li>
							</ul>
						</li>
						<li><h3>Forms & Icons</h3></li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-file-text"></i><span class="side-menu__label">Forms</span><span class="badge bg-success side-badge">5</span></a>
							<ul class="slide-menu">
								<li><a href="{{ url('form-elements') }}" class="slide-item"> Form Elements</a></li>
								<li><a href="{{ url('form-advanced') }}" class="slide-item"> Form Advanced</a></li>
								<li><a href="{{ url('wysiwyag') }}" class="slide-item"> Form Editor</a></li>
								<li><a href="{{ url('form-wizard') }}" class="slide-item"> Form Wizard</a></li>
								<li><a href="{{ url('form-validation') }}" class="slide-item"> Form Validation</a></li>
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-command"></i><span class="side-menu__label">Icons</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ url('icons') }}" class="slide-item"> Font Awesome</a></li>
								<li><a href="{{ url('icons2') }}" class="slide-item"> Material Design Icons</a></li>
								<li><a href="{{ url('icons3') }}" class="slide-item"> Simple Line Icons</a></li>
								<li><a href="{{ url('icons4') }}" class="slide-item"> Feather Icons</a></li>
								<li><a href="{{ url('icons5') }}" class="slide-item"> Ionic Icons</a></li>
								<li><a href="{{ url('icons6') }}" class="slide-item"> Flag Icons</a></li>
								<li><a href="{{ url('icons7') }}" class="slide-item"> pe7 Icons</a></li>
								<li><a href="{{ url('icons8') }}" class="slide-item"> Themify Icons</a></li>
								<li><a href="{{ url('icons9') }}" class="slide-item">Typicons Icons</a></li>
								<li><a href="{{ url('icons10') }}" class="slide-item">Weather Icons</a></li>
							</ul>
						</li>
						<li><h3>Pages</h3></li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-layers"></i><span class="side-menu__label">Pages</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ url('profile') }}" class="slide-item"> Profile</a></li>
								<li><a href="{{ url('editprofile') }}" class="slide-item"> Edit Profile</a></li>
								<li><a href="{{ url('email') }}" class="slide-item"> Mail-Inbox</a></li>
								<li><a href="{{ url('emailservices') }}" class="slide-item"> Mail-Compose</a></li>
								<li><a href="{{ url('gallery') }}" class="slide-item"> Gallery</a></li>
								<li><a href="{{ url('about') }}" class="slide-item"> About Company</a></li>
								<li><a href="{{ url('services') }}" class="slide-item"> Services</a></li>
								<li><a href="{{ url('faq') }}" class="slide-item"> FAQS</a></li>
								<li><a href="{{ url('terms') }}" class="slide-item"> Terms</a></li>
								<li><a href="{{ url('invoice') }}" class="slide-item"> Invoice</a></li>
								<li><a href="{{ url('pricing') }}" class="slide-item"> Pricing Tables</a></li>
								<li><a href="{{ url('blog') }}" class="slide-item"> Blog</a></li>
								<li><a href="{{ url('emptypage') }}" class="slide-item"> Empty Page</a></li>
								<li><a href="{{ url('construction') }}" class="slide-item"> Under Construction</a></li>
							</ul>
						</li>
						<li><h3>E-Commerce</h3></li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-shopping-cart"></i><span class="side-menu__label">E-Commerce</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ url('shop') }}" class="slide-item"> Shop</a></li>
								<li><a href="{{ url('shop-description') }}" class="slide-item">Product Details</a></li>
								<li><a href="{{ url('cart') }}" class="slide-item"> Shopping Cart</a></li>
								<li><a href="{{ url('wishlist') }}" class="slide-item"> Wishlist</a></li>
								<li><a href="{{ url('checkout') }}" class="slide-item"> Checkout</a></li>
							</ul>
						</li>
						<li><h3>Custom & Error Pages</h3></li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-settings"></i><span class="side-menu__label">Custom Pages</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ url('login') }}" class="slide-item"> Login</a></li>
								<li><a href="{{ url('register') }}" class="slide-item"> Register</a></li>
								<li><a href="{{ url('forgot-password') }}" class="slide-item"> Forgot Password</a></li>
								<li><a href="{{ url('lockscreen') }}" class="slide-item"> Lock screen</a></li>
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#"><i class="side-menu__icon fe fe-info"></i><span class="side-menu__label">Error Pages</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="{{ url('error400') }}" class="slide-item"> 400</a></li>
								<li><a href="{{ url('error401') }}" class="slide-item"> 401</a></li>
								<li><a href="{{ url('error403') }}" class="slide-item"> 403</a></li>
								<li><a href="{{ url('error404') }}" class="slide-item"> 404</a></li>
								<li><a href="{{ url('error500') }}" class="slide-item"> 500</a></li>
								<li><a href="{{ url('error503') }}" class="slide-item"> 503</a></li>
							</ul>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="#">
							<i class="side-menu__icon fe fe-sliders"></i>
							<span class="side-menu__label">Submenus</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a href="#" class="slide-item">Level-1</a></li>
								<li class="sub-slide">
									<a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="#"><span class="sub-side-menu__label">Level-2</span><i class="sub-angle fa fa-angle-right"></i></a>
									<ul class="sub-slide-menu">
										<li><a class="sub-slide-item" href="#">Level-2.1</a></li>
										<li><a class="sub-slide-item" href="#">Level-2.2</a></li>
										<li class="sub-slide2">
											<a class="sub-side-menu__item2" href="#" data-bs-toggle="sub-slide2"><span class="sub-side-menu__label2">Level-2.3</span><i class="sub-angle2 fa fa-angle-right"></i></a>
											<ul class="sub-slide-menu2">
												<li><a href="#" class="sub-slide-item2">Level-2.3.1</a></li>
												<li><a href="#" class="sub-slide-item2">Level-2.3.2</a></li>
												<li><a href="#" class="sub-slide-item2">Level-2.3.3</a></li>
											</ul>
										</li>
										<li><a class="sub-slide-item" href="#">Level-2.4</a></li>
										<li><a class="sub-slide-item" href="#">Level-2.5</a></li>
									</ul>
								</li>
							</ul>
						</li> -->
					</ul>
				</aside>
				<!--/APP-SIDEBAR-->
