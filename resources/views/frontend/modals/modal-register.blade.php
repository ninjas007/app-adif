<!-- Modal Pilih Template-->
<div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="modalRegister" aria-hidden="true">
    <div class="modal-dialog d-flex align-items-center justify-content-center vh-100">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 p-5">
                        <form id="registerForm" method="post">
                            <div class="form-group mb-3">
                                <label class="label-form" for="email2">Email</label>
                                <input type="text" id="email2" class="form-control"
                                    placeholder="Enter email">

                                <div class="t mb-3 mt-1" id="msgEmailRegister"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label-form" for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control"
                                    placeholder="Enter phone">

                                <div class="mb-3 mt-1" id="msgPhoneRegister"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label-form" for="password2">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password2" class="form-control" placeholder="Enter password">
                                    <div class="input-group-prepend" onclick="showPassword('password2')">
                                        <div class="input-group-text">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 mt-1" id="msgPasswordRegister"></div>
                            </div>

                            <div class="text-success mb-3 mt-1 text-center font-weight-bold" id="successRegister"></div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-3" id="btnSignup">
                                <i class="fa fa-user"></i>&nbsp;Sign up
                            </button>
                        </form>
                        <p class="text-center">Already registered? <a href="javascript:void(0)"
                                class="text-primary" onclick="login()">Sign in</a></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
