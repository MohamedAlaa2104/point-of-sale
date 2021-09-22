<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" target="_blank" href="{{ url('/' . $page='') }}"><img src="{{URL::asset('imgs/logo.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('imgs/logo.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" target="_blank" href="{{ url('/' . $page='') }}"><img src="{{URL::asset('imgs/logo.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('imgs/logo.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{auth()->user()->getFirstMediaUrl('avatar') ? auth()->user()->getFirstMediaUrl('avatar') : URL::asset('assets/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->name}}</h4>
							<span class="mb-0 text-muted">{{auth()->user()->getRoleNames()->first()}}</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">@lang('dashboard.dashboard')</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ route('dashboard.index') }}">
							<i class="mg-x-10 fa fa-home"></i>
                            <span class="side-menu__label">@lang('dashboard.index')</span>
{{--                            <span class="badge badge-success side-badge">1</span>--}}
                        </a>
					</li>
                    @if (auth()->user()->can('read roles') || auth()->user()->can('read user'))
                        <li class="side-item side-item-category">@lang('dashboard.manage-users')</li>
                    @endif
                    @can('read roles')
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#">
							<i class="mg-x-10 fa fa-users"></i>
							<span class="side-menu__label">@lang('dashboard.roles')</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('dashboard.roles.index') }}">@lang('dashboard.show')</a></li>
                            @can('create roles')
							<li><a class="slide-item" href="{{ route('dashboard.roles.create') }}">@lang('dashboard.add')</a></li>
                            @endcan
						</ul>
					</li>
                    @endcan

                    @can('read user')
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<i class="mg-x-10 fa fa-user"></i>
							<span class="side-menu__label">@lang('dashboard.users')</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('dashboard.users.index') }}">@lang('dashboard.show')</a></li>
                            @can('create user')
                            <li><a class="slide-item" href="{{ route('dashboard.users.create') }}">@lang('dashboard.add')</a></li>
                            @endcan
						</ul>
					</li>
                    @endcan

                    <li class="side-item side-item-category">@lang('dashboard.main')</li>
{{--                    @can('read services')--}}
{{--					<li class="slide">--}}
{{--						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">--}}
{{--							<i class="mg-x-10 fa fa-sitemap"></i>--}}
{{--							<span class="side-menu__label">@lang('dashboard.services')</span><i class="angle fe fe-chevron-down"></i></a>--}}
{{--						<ul class="slide-menu">--}}
{{--							@can('read it requests')--}}
{{--								<li><a class="slide-item" href="{{ route('dashboard.service.it') }}">@lang('dashboard.it_requests')</a></li>--}}
{{--							@endcan--}}
{{--							@can('read env requests')--}}
{{--								<li><a class="slide-item" href="{{ route('dashboard.service.environment') }}">@lang('dashboard.env_requests')</a></li>--}}
{{--							@endcan--}}
{{--							<li><a class="slide-item" href="{{ route('dashboard.services.index') }}">@lang('dashboard.show')</a></li>--}}
{{--							@can('create services')--}}
{{--							<li><a class="slide-item" href="{{ route('dashboard.services.create') }}">@lang('dashboard.create')</a></li>--}}
{{--							@endcan--}}
{{--						</ul>--}}
{{--					</li>--}}
{{--                    @endcan--}}

{{--					@can('read agencies')--}}
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
								<i class="mg-x-10 far fa-handshake"></i>
								<span class="side-menu__label">@lang('dashboard.categories')</span><i class="angle fe fe-chevron-down"></i></a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="{{ route('dashboard.category.index') }}">@lang('dashboard.show')</a></li>
{{--								@can('read agencies')--}}
								<li><a class="slide-item" href="{{ route('dashboard.category.create') }}">@lang('dashboard.create')</a></li>
{{--								@endcan--}}
							</ul>
						</li>
{{--					@endcan--}}
                    @can('read products')
                    <li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<i class="mg-x-10 fa fa-shopping-cart"></i>
							<span class="side-menu__label">@lang('dashboard.products')</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
                            <li><a class="slide-item" href="{{ route('dashboard.products.index') }}">@lang('dashboard.show')</a></li>
                            @can('create products')
                            <li><a class="slide-item" href="{{ route('dashboard.products.create') }}">@lang('dashboard.create')</a></li>
                            @endcan
						</ul>
					</li>
                    @endcan
					@can('read orders')
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<i class="mg-x-10 fa fa-cubes"></i>
							<span class="side-menu__label">@lang('dashboard.orders')</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('dashboard.orders.index') }}">@lang('dashboard.show')</a></li>
						</ul>
					</li>
					@endcan
					@can('read customers')
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
							<i class="mg-x-10 icon ion-ios-contacts"></i>
							<span class="side-menu__label">@lang('dashboard.customers')</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ route('dashboard.customers.index') }}">@lang('dashboard.show')</a></li>
							@can('create customers')
							<li><a class="slide-item" href="{{ route('dashboard.customers.create') }}">@lang('dashboard.create')</a></li>
							@endcan
						</ul>
					</li>
					@endcan

					@can('settings')
					<li class="side-item side-item-category">@lang('dashboard.settings')</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
								<i class="mg-x-10 fa fa-cogs"></i>
								<span class="side-menu__label">
									@lang('dashboard.settings')
								</span>
								<i class="angle fe fe-chevron-down">

								</i>
							</a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="{{ route('dashboard.settings.index') }}">@lang('dashboard.show')</a></li>
							</ul>
						</li>
					@endcan


				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
