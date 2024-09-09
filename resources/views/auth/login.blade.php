@include('admin.layout.header')
<div class="auth-page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-sm-5 mb-4 text-white-50">
                    <div>
                        <a href="{{ route('auth.login') }}">
                            <img width="150" height="150" src="{{ url('assets/images/LOGO-DEAH2-Photoroom.png') }} "
                                alt="" height="20">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mt-2">

                    <div class="card-body p-4">

                        <div class="p-2 mt-4">
                            <form class="needs-validation" novalidate action="{{ route('auth.login') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="useremail" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="useremail" name="email"
                                        placeholder="Enter email address" required>
                                    <div class="invalid-feedback">
                                        Please enter email
                                    </div>
                                    @error('email')
                                        <span class="text-danger"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password-input">Password<span
                                            class="text-danger">*</span></label>
                                    <div class="position-relative auth-pass-inputgroup">
                                        <input type="password" class="form-control pe-5 password-input" name="password"
                                            onpaste="return false" placeholder="Enter password" id="password-input"
                                            aria-describedby="passwordInput"
                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                        <div class="invalid-feedback">
                                            Please enter password
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="text-danger"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>

                                <div class=" text-right">
                                    <div class="signin-other-title">
                                        <h5 class="fs-13 title text-muted text-primary"><a
                                                href="{{ route('auth.repass') }}">Forget pass ?
                                            </a></h5>
                                    </div>

                                </div>


                                <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                    <h5 class="fs-13">Password must contain:</h5>
                                    <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                                    <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                                    <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)
                                    </p>
                                    <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
                                </div>

                                <div class="mt-4">
                                    <button class="btn btn-success w-100" type="submit">Sign In</button>
                                </div>

                                <div class="mt-4 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="fs-13 mb-4 title text-muted"><a
                                                href="{{ route('auth.resgister') }}">Sign Up</a></h5>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
@include('admin.layout.footer')
