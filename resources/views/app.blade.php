<!DOCTYPE html>
<html lang="en">

@include('commons.header')

<body>
	<body class="nav-md">

	<div class="container body">
		<div class="main_container">
			
			@include('commons.sidebar')

			<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
						<div class="page-title">
								<div class="title_left">
										<h3>{{ isset($pageTitle) != null ? $pageTitle : 'Optimus' }}</h3>
								</div>

								@include('commons.search')
						</div>
						<div class="clearfix"></div>

						@include ('commons.notifications')

						@yield('content')

					</div>
				</div>
			</div>
		</div>

	@include('commons.footer')

	</body>
</html>
