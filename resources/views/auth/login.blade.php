<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
	<base href="../../../">
	<title>Remfly | Login</title>
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="{{ asset('backend/media/shortcut_icon.png') }}" />
	<!--begin::Fonts-->
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en-hk" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Remfly" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="{{ asset('backend/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('backend/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
	<!--begin::Main-->
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Authentication - Sign-in -->
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<!--begin::Aside-->
			<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #FFFFFF">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
					<!--begin::Content-->
					<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20" style="margin-top: 200px;">
						<!--begin::Logo-->
						<div class="mb-5">
							<img alt="Logo" src="{{ asset('backend/media/remfly/images/Remfly-login-logo.svg') }}" style="width: 244px; height: 138px;" />
						</div>
						<!--end::Logo-->

					</div>
					<!--end::Content-->
					<!--begin::Illustration-->
					<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="margin-bottom: 50px; width: 500px; height: 500px;background-image: url({{ asset('backend/media/remfly/images/login-image.svg') }}"></div>
					<!--end::Illustration-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Aside-->
			<!--begin::Body-->
			<div class="d-flex flex-column flex-lg-row-fluid py-10" style="background-color: #F3F5F9;">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid">
					<!--begin::Wrapper-->
					<div class="w-lg-500px p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form class="form w-100" action="{{ route('post.login') }}" method="POST">
							@csrf
							<!--begin::Heading-->
							<div class="mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Sign In</h1>
								<!--end::Title-->
							</div>
							@if(session('error'))
							<div class="mb-10">
								<!--begin::Title-->
								<div class="alert alert-danger">
									{{ session('error') }}
								</div>
								<!--end::Title-->
							</div>
							@endif
							<!--begin::Heading-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Label-->
								<label class="form-label fs-6 fw-bolder text-dark">Email</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input id="email" type="email" style="background-color: #fff;" class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack mb-2">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
									<!--end::Label-->
									<!--begin::Link-->
									@if (Route::has('password.request'))
									<a class="link-primary fs-6 fw-bolder" href="{{ route('password.request') }}">
										Forgot Password?
									</a>
									@endif
									<!--end::Link-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Input-->
								<input id="password" type="password" style="background-color: #fff;" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
								<!--end::Input-->
							</div>
							<div class="row mb-10">
								<div class="col-md-6" style="margin-left: 60%;">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

										<label class="form-check-label" for="remember">
											{{ __('Remember Me') }}
										</label>
									</div>
								</div>
							</div>
							<!--end::Input group-->

							<!--begin::Actions-->
							<!--end::Input group-->
							<div class="fv-row mb-10">
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack mb-2">
										{!! NoCaptcha::renderJs() !!}
										{!! NoCaptcha::display() !!}
									</div>
									@error('g-recaptcha-response')
									<div class="alert alert-danger" role="alert">{{$message}}</div>
									@enderror	
								</div>
								<!--begin::Actions-->
							<div class="">
								<!--begin::Submit button-->
								<button type="submit" class="btn btn-lg btn-primary mb-5" style="width: 30%;">
									<span class="indicator-label">Sign In</span>
								</button>
								<!--end::Submit button-->
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Authentication - Sign-in-->
	</div>
	<!--end::Root-->
	<!--end::Main-->
	<!--begin::Javascript-->
	<script>
		var hostUrl = "assets/";
	</script>
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="{{ asset('backend/plugins/global/plugins.bundle.js') }}"></script>
	<script src="{{ asset('backend/js/scripts.bundle.js') }}"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Page Custom Javascript(used by this page)-->
	<script src="{{ asset('backend/js/custom/authentication/sign-in/general.js') }}"></script>
	<!--end::Page Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>