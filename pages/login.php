<!doctype HTML>
<html>
    <head>
        <title>Anmelden | MAUT</title>
        
        <?php include '../code/head.html'; ?>
        
        <style>
            body {margin: auto; width: 400px;}
            
        /*    --------------------------------------------------
	:: Login Section
	-------------------------------------------------- */
#login {
    padding-top: 50px;
}
#login .form-wrap {
    width: 100%;
    margin: 0 auto;
}
#login h1 {
    color: #2980b9;
    font-size: 18px;
    text-align: center;
    font-weight: bold;
    padding-bottom: 20px;
}
#login .form-group {
    margin-bottom: 25px;
}
#login .checkbox {
    margin-bottom: 20px;
    position: relative;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
}
#login .checkbox.show:before {
    content: '\e013';
    color: #1fa67b;
    font-size: 17px;
    margin: 1px 0 0 3px;
    position: absolute;
    pointer-events: none;
    font-family: 'Glyphicons Halflings';
}
#login .checkbox .character-checkbox {
    width: 25px;
    height: 25px;
    cursor: pointer;
    border-radius: 3px;
    border: 1px solid #ccc;
    vertical-align: middle;
    display: inline-block;
}
#login .checkbox .label {
    color: #6d6d6d;
    font-size: 13px;
    font-weight: normal;
}
#login .btn.btn-custom {
    font-size: 14px;
	margin-bottom: 20px;
}
#login .forget {
    font-size: 13px;
	text-align: center;
	display: block;
}

/*    --------------------------------------------------
	:: Inputs & Buttons
	-------------------------------------------------- */
.form-control {
    color: #212121;
}
.btn-custom {
    color: #fff;
	background-color: #2980b9;
}
.btn-custom:hover,
.btn-custom:focus {
    color: #fff;
}
        </style>
    </head>
    
    <body>
        <section id="login">
            <div class="container">
                <div class="row">
                        <div class="form-wrap">
                        <h1><img src="../img/logo.png" width="150px" /></h1>
                            <form role="form" action="<?= $_SERVER['PHP_SELF'];?>" method="post" id="login-form" autocomplete="off">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Benutzername">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="key" id="key" class="form-control" placeholder="Passwort">
                                </div>
                                <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Anmelden">    
                            </form>
                            
                            <!--<div class="alert alert-success" role="alert"><center>Erfolgreich abgemeldet.</center></div>-->
                            <!--<div class="alert alert-danger" role="alert"><center><b>Fehler!</b> Anmeldedaten sind nicht korrekt.</center></div>-->
                        </div>
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>
    </body>
</html>