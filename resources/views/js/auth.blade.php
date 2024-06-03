<script type="text/javascript">
    function signup() {
        $('#modalLogin').modal('hide');
        $('#modalRegister').modal('show');

        resetValueLogin();
        resetStyleRegister();
    }

    function login() {
        $('#modalLogin').modal('show');
        $('#modalRegister').modal('hide');

        resetStyleLogin();
        resetStyleRegister();
    }

    function styleValidLogin() {
        $('#email').addClass('is-valid');
        $('#password').addClass('is-valid');

        $('#email').removeClass('is-invalid');
        $('#password').removeClass('is-invalid');
    }

    function styleInvalidLogin() {
        $('#email').addClass('is-invalid');
        $('#password').addClass('is-invalid');

        $('#email').removeClass('is-valid');
        $('#password').removeClass('is-valid');
    }

    function resetStyleLogin() {
        $('#email').removeClass('is-valid');
        $('#password').removeClass('is-valid');
        $('#email').removeClass('is-invalid');
        $('#password').removeClass('is-invalid');

        $('#error').text('');
        $('#success').text('');
    }

    function resetValueLogin() {
        $('#email').val('');
        $('#email2').val('');
        $('#password').val('');
        $('#password2').val('');

        $('#email').removeClass('is-valid');
        $('#password').removeClass('is-valid');
        $('#email').removeClass('is-invalid');
        $('#password').removeClass('is-invalid');
    }

    function styleValidRegister() {
        $('#email2').addClass('is-valid');
        $('#password2').addClass('is-valid');
        $('#phone').addClass('is-valid');
    }

    function resetStyleRegister() {
        $('#email2').removeClass('is-invalid');
        $('#password2').removeClass('is-invalid');
        $('#phone').removeClass('is-invalid');

        $('#msgEmailRegister').text('');
        $('#msgPhoneRegister').text('');
        $('#msgPasswordRegister').text('');

        $('#successRegister').text('');
    }

    function afterRequestRegister(status = 'failed') {
        if (status == 'success') {
            $('#email2').val('');
            $('#password2').val('');
            $('#phone').val('');
        }
    }

    // login
    $('#loginForm').submit(function(event) {
        event.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            url: "{{ route('login.user') }}",
            type: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email: email,
                password: password
            },
            beforeSend: function() {
                resetStyleLogin();
                $('#btnSignin').addClass('disabled');
            },
            success: function(data, textStatus, xhr) {
                if (xhr.status == 200) {
                    $('#success').text(data.message);
                    $('#btnSignin').removeClass('disabled');

                    styleValidLogin();
                    setTimeout(() => {
                        window.location.href = `{{ route('home') }}`
                    }, 2000);
                } else {
                    styleInvalidLogin();

                    $('#btnSignin').removeClass('disabled');
                    $('#error').text(data.message);
                }
            },
            error: function(xhr) {
                styleInvalidLogin();
                $('#error').text(xhr.responseJSON.message);
                $('#btnSignin').removeClass('disabled');
            }
        });
    });

    // register
    $('#registerForm').submit(function(event) {
        event.preventDefault();
        const email = $('#email2').val();
        const password = $('#password2').val();
        const phone = $('#phone').val();

        $.ajax({
            url: "{{ route('signup.user') }}",
            type: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email: email,
                password: password,
                phone: phone
            },
            beforeSend: function() {
                resetStyleRegister();
                $('#btnSignup').addClass('disabled');
            },
            success: function(data, textStatus, xhr) {
                afterRequestRegister('success');
                $('#btnSignup').removeClass('disabled');
                if (xhr.status == 200) {
                    setTimeout(() => {
                        $('#successRegister').text(data.message);
                    }, 2000);
                }
            },
            error: function(xhr) {
                const emailErrors = xhr.responseJSON.errors.email;
                const phoneErrors = xhr.responseJSON.errors.phone;
                const passwordErrors = xhr.responseJSON.errors.password;

                if (emailErrors) {
                    let htmlError = '';
                    $.each(emailErrors, function(key, value) {
                        htmlError += `<div class="text-danger mb-1">${value}</div>`
                    })
                    $('#msgEmailRegister').html(htmlError);
                    $('#email2').addClass('is-invalid');
                }

                if (phoneErrors) {
                    let htmlError = '';
                    $.each(phoneErrors, function(key, value) {
                        htmlError += `<div class="text-danger mb-1">${value}</div>`
                    })
                    $('#msgPhoneRegister').html(htmlError);
                    $('#phone').addClass('is-invalid');
                }

                if (passwordErrors) {
                    let htmlError = '';
                    $.each(passwordErrors, function(key, value) {
                        htmlError += `<div class="text-danger mb-1">${value}</div>`
                    })
                    $('#msgPasswordRegister').html(htmlError);
                    $('#password2').addClass('is-invalid');
                }

                afterRequestRegister()
                $('#btnSignup').removeClass('disabled');
            }
        });
    });
</script>
