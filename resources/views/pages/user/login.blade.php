@extends('layouts.home', ['title' => 'SiKEMA | Login'])

@section('content')
<main class="d-flex flex-column u-hero u-hero--end mnh-100vh" style="background-image: url(assets/img-temp/bg/bg-1.png);">
    <div class="container py-11 my-auto">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-5">
                <!-- Card -->
                <div class="card">
                    <!-- Card Body -->
                    <div class="card-body p-4 p-lg-7">
                        <h2 class="text-center mb-4">Sign in</h2>

                        <!-- Sign in Form -->
                        <form action="{{ route('auth.login-action') }}" method="POST">
                            @csrf
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email / NIM / NIP</label>
                                <input id="email" name="email" class="form-control" placeholder="Masukkan email / NIM / NIP anda">
                            </div>
                            <!-- End Email -->

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" name="password" class="form-control" type="password" placeholder="Masukkan password anda">
                            </div>
                            <!-- End Password -->

                            <div class="d-flex align-items-center justify-content-between my-4">
                                <!-- Remember -->
                                <!-- <div class="custom-control custom-checkbox">
                                    <input id="rememberMe" class="custom-control-input" type="checkbox">
                                    <label class="custom-control-label text-dark" for="rememberMe">Remember me</label>
                                </div> -->
                                <!-- End Remember -->

                                <a class="font-weight-semi-bold" href="account-password-recover.html">Forgot password?</a>
                            </div>

                            <button type="submit" class="btn btn-block btn-wide btn-primary text-uppercase">Sing Up</button>

                        </form>
                        <!-- End Sign in Form -->
                    </div>
                    <!-- End Card Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="u-footer mt-auto">
        <div class="container">
            <div class="d-md-flex align-items-md-center text-center text-md-left text-muted">
                <!-- Footer Menu -->
                <ul class="list-inline mb-3 mb-md-0">
                    <li class="list-inline-item mr-4">
                        <a class="text-muted" href="https://www.facebook.com/htmlstream" target="_blank">About Htmlstream</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="https://htmlstream.com/" target="_blank">More Freebies</a>
                    </li>
                </ul>
                <!-- End Footer Menu -->

                <!-- Copyright -->
                <span class="text-muted ml-auto">&copy; 2019 <a class="text-muted" href="https://htmlstream.com/" target="_blank">Htmlstream</a>. All Rights Reserved.</span>
                <!-- End Copyright -->
            </div>
        </div>
    </footer>
    <!-- End Footer -->
</main>
@endsection