<!-- Modal Pilih Template-->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLogin" aria-hidden="true">
    <div class="modal-dialog d-flex align-items-center justify-content-center vh-100">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 p-5">
                        <form id="loginForm" method="post">
                            @csrf
                            <div class="text-center mb-3">
                                <p>Login with:</p>
                                {{-- <a href="{{ url('auth/facebook') }}" class="btn btn-secondary btn-lg btn-floating mx-1" title="Login with Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a> --}}

                                <a href="{{ url('auth/google') }}" class="btn btn-danger btn-lg btn-floating mx-1" title="Login with Google">
                                    <i class="fab fa-google"></i>
                                </a>

                            </div>

                            <p class="text-center">or:</p>

                            <div class="form-group mb-3">
                                <label class="label-form" for="email">Email</label>
                                <input type="text" id="email" name="email" class="form-control"
                                placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label class="label-form" for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Enter password">
                                    <div class="input-group-prepend" onclick="showPassword('password')">
                                        <div class="input-group-text">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-danger mb-3 mt-1" id="error"></div>
                            <div class="text-success mb-3 mt-1" id="success"></div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-3" id="btnSignin">
                                <i class="fa fa-sign-in"></i>&nbsp;Sign in
                            </button>
                        </form>
                        <p class="text-center">Not registered? Join now <a href="javascript:void(0)"
                                class="text-primary" onclick="signup()">Sign up</a></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
