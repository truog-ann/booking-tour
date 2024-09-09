@include('admin.layout.header')
<div class="auth-page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-sm-3 mb-2 text-white-50">
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
                            <form class="needs-validation" novalidate action="{{ route('auth.resgister') }}"
                                method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="useremail" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="useremail" name="email"
                                        value="{{ old('email') }}" placeholder="Enter email address">
                                    <div class="invalid-feedback">
                                        Please enter email
                                    </div>
                                    @error('email')
                                        <span class="text-danger"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="useremail" class="form-label">Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" placeholder="Enter name " required>
                                    <div class="invalid-feedback">
                                        Please enter name
                                    </div>
                                    @error('name')
                                        <span class="text-danger"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password-input">Password<span
                                            class="text-danger">*</span></label>
                                    <div class="position-relative auth-pass-inputgroup">
                                        <input type="password" class="form-control pe-5 password-input" name="password"
                                            placeholder="Enter password" id="password-register">

                                        <div class="invalid-feedback">
                                            Please enter password
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="text-danger"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password-input">Password confirm<span
                                            class="text-danger">*</span></label>
                                    <div class="position-relative auth-pass-inputgroup">
                                        <input type="password" class="form-control pe-5 password-input"
                                            name="password_confirm" placeholder="Enter password confirm"
                                            id="password-register-confirm">

                                        <div class="invalid-feedback">
                                            Please enter password
                                        </div>
                                    </div>
                                    @error('password_confirm')
                                        <span class="text-danger"><i>{{ $message }}</i></span>
                                    @enderror
                                </div>
                                <div class="mt-4">
                                    <button class="btn btn-success w-100" type="submit">Sign Up</button>
                                </div>

                                <div class="mt-4 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="fs-13 mb-4 title text-muted"><a href="{{ route('auth.login') }}">Sign
                                                In</a> </h5>
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
<script>
    $('#password-addon').on('click', function() {
        if ($('#password-register').attr('type') == 'text') {
            $('#password-register').attr('type') = 'password'
        } else {
            $('#password-register').attr('type') = 'text'
        }

    })
</script>
