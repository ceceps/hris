<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Login Admin </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets\images\favicon.ico') }}" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components\bootstrap\css\bootstrap.min.css')}} ">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets\icon\themify-icons\themify-icons.css') }}">
    <!-- sweetalert -->
    <link rel="stylesheet" href="{{ asset('assets\bower_components\sweetalert\css\sweetalert.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets\icon\icofont\css\icofont.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets\css\style.css') }}">
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                        <div id="main">
                            <form class="md-float-material form-material" id="formlogin">
                                @csrf
                                <div class="text-center">
                                    <img src="{{ asset('assets\images\logo.png') }}" alt="logo.png">
                                </div>
                                <div class="auth-box card">
                                    <div class="card-block">
                                        <div class="row m-b-20">
                                            <div class="col-md-12">
                                                <h3 class="text-center">{!! session('error') !!}</h3>
                                                <h3 class="text-center">Sign In</h3>
                                            </div>
                                        </div>
                                        <div class="form-group form-primary">
                                            <input type="text" name="email" class="form-control email" id="email" required="required" placeholder="Insert E-mail">
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary">
                                            <input type="password" name="password" class="form-control password" id="password" required="" placeholder="Insert Password">
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="row m-t-25 text-left">
                                            <div class="col-12">
                                                <div class="checkbox-fade fade-in-primary d-">
                                                    <label>
                                                        <input type="checkbox" value="">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                        <span class="text-inverse">Remember me</span>
                                                    </label>
                                                </div>
                                                <div class="forgot-phone text-right f-right">
                                                    <a href="auth-reset-password.htm" class="text-right f-w-600"> Forget Password?</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row m-t-30">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20" id="btnlogin">Sign in</button>
                                                {{-- <button type="button" class="btn btn-info btn-md btn-block waves-effect waves-light text-center m-b-20" id="btndaftar">Register</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            {{-- FORM REGISTER --}}
                            {{-- <form class="md-float-material form-material" id="formdaftar">
                                <div class="text-center">
                                    <img src="{{ asset('assets\images\logo.png') }}" alt="logo.png">
                                </div>
                                <div class="auth-box card">
                                    <div class="card-block">
                                        <div class="row m-b-20">
                                            <div class="col-md-12">
                                                <h3 class="text-center txt-primary">Daftar Akun</h3>
                                            </div>
                                        </div>
                                        <div class="form-group form-primary">
                                            <input type="text" name="name" class="form-control name" id="name" required="" placeholder="Name">
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary">
                                            <input type="text" name="email" class="form-control email" id="email" required="" placeholder="Email">
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="form-group form-primary">
                                            <input type="password" name="password" class="form-control password" id="password" required="" placeholder="Password">
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="row m-t-25 text-left">
                                            <div class="col-md-12">
                                                <div class="checkbox-fade fade-in-primary">
                                                    <label>
                                                        <input type="checkbox" value="">
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                        <span class="text-inverse">I read and accept <a href="#">Terms &amp; Conditions.</a></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row m-t-30">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" id="btndaftar2">Sign up now</button>
                                                <button type="button" class="btn btn-info btn-md btn-block waves-effect text-center m-b-20" id="btnlogin2">Sign in</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form> --}}
                        </div>
                        <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="../files/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="../files/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="../files/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('assets/bower_components\jquery\js\jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components\jquery-ui\js\jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components\popper.js\js\popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components\bootstrap\js\bootstrap.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('assets/bower_components\jquery-slimscroll\js\jquery.slimscroll.js') }}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset('assets/bower_components\modernizr\js\modernizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components\modernizr\js\css-scrollbars.js') }}"></script>
    <!-- sweetalert -->
    <script src="{{ asset('assets\bower_components\sweetalert\js\sweetalert.min.js')}}"></script>
    <!-- Jquery Validation -->
    <script src="{{ asset('assets\pages\jquery-validation-1.19.1\dist\jquery.validate.js')}}"></script>
    <script src="{{ asset('assets\pages\jquery-validation-1.19.1\dist\additional-methods.min.js')}}"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{ asset('assets/bower_components\i18next\js\i18next.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/bower_components\jquery-i18next\js\jquery-i18next.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets\js\common-pages.js') }}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script>
//Halaman Login
$('#formdaftar').css("visibility","hidden");
$('#formdaftar').css({"position" : "absolute","top":"0%","left":"30.3%"});
$('#btndaftar').click(function(){
    $('#main').css("position","relative");
    $('#main').animate({ left: "15%", },150, function(){
        $('#main').animate({ left: "0%", },150);
        $('#formlogin').css("visibility","hidden");
        $('#formdaftar').css("visibility","visible");
    });
});

$('#btnlogin2').click(function(){
    $('#main').css("position","relative");
    $('#main').animate({ left: "15%", },150, function(){
        $('#formdaftar').css("visibility","hidden");
        $('#main').animate({ left: "0%", },150);
        $('#formlogin').css("visibility","visible");
    });
});

$('#formlogin').validate({
	rules: {
		email : {
			required: true,
			maxlength: 100,
			email : true,
		},
		password : {
			required : true,
			maxlength : 100
		},
	},
	messages : {
		email : {
			required : "Error! Email cannot be empty",
			maxlength : "Error! max 100 character",
            email : "Invalid email format"
		},
		password : {
			required : "Error! Password cannot be empty",
			maxlength : "Error! max 100 character"
		},
	},
	submitHandler: function(form) {
		var serializedData = $(form).serialize();
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: "POST",
			url : "{{ url('/login') }}",
			dataType:"json",
			data: serializedData,
			cache: false,
            processData: false,
				success: function(data) {
                    if(data.status == true){
                        swal("Success!", data.msg, {
                            icon : "success",
                            buttons: {
                                confirm: {
                                    className : 'btn btn-success'
                                }
                            },
                        }).then(function(){
                            $('.modal').modal('hide');

                        });

                        setTimeout(function() {
                            window.location.href = data.redirect;
                        }, 1000);
                    }else{
                        swal("Failed!", data.msg, {
                            icon : "error",
                            buttons: {
                                confirm: {
                                    className : 'btn btn-danger'
                                }
                            },
                        }).then(function(){
                            $('.modal').modal('hide');
                        });
                    }
			},
			error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
                var errorsHtml = '';
                $.each(errors.errors, function( key, value ) {
                    errorsHtml +=  value[0]+'\n';
                });

                swal('Failed!',errorsHtml,{
                    icon : "error",
                    buttons: {
                        confirm: {
                            className : 'btn btn-danger'
                        }
                    },
                });
            }
		});
		return false;
	}
});

$('#formdaftar').validate({
	rules: {
		nama : {
			required: true,
			maxlength: 100,
		},
        email : {
			required: true,
			maxlength: 100,
			email : true,
		},
		password : {
			required : true,
			maxlength : 100
		},
	},
	messages : {
		nama : {
			required : "Error! Name cannot be empty",
			maxlength : "Error! max 100 character",
		},
        email : {
			required : "Error! Email cannot be empty",
			maxlength : "Error! max 100 character",
            email : "Invalid email format"
		},
		password : {
			required : "Error! Password cannot be empty",
			maxlength : "Error! max 100 character"
		},
	},
	submitHandler: function(form) {
		var serializedData = $(form).serialize();
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			type: "POST",
			url : "{{ url('daftarPost') }}",
			dataType:"json",
			data: serializedData,
			cache: false,
            processData: false,
				success: function(data) {
                    if(data.status == true){
                        swal("Success!", data.msg, {
                            icon : "success",
                            buttons: {
                                confirm: {
                                    className : 'btn btn-success'
                                }
                            },
                        }).then(function(){
                            $('.modal').modal('hide');
                            $('#main').css("position","relative");
                            $('#main').animate({ left: "15%", },150, function(){
                                $('#formdaftar').css("visibility","hidden");
                                $('#main').animate({ left: "0%", },150);
                                $('#formlogin').css("visibility","visible");
                                $('#email').val(data.session);
                            });
                        });
                    }else{
                        swal("Failed!", data.msg, {
                            icon : "error",
                            buttons: {
                                confirm: {
                                    className : 'btn btn-danger'
                                }
                            },
                        }).then(function(){
                            $('.modal').modal('hide');
                        });
                    }
			},
			error: function(data) {
                var errors = data.responseJSON;
                console.log(errors);
                var errorsHtml = '';
                $.each(errors.errors, function( key, value ) {
                    errorsHtml +=  value[0]+'\n';
                });

                swal('Failed!',errorsHtml,{
                    icon : "error",
                    buttons: {
                        confirm: {
                            className : 'btn btn-danger'
                        }
                    },
                });
            }
		});
		return false;
	}
});
  window.dataLayer = window.dataLayer || [];

</script>
</body>

</html>
