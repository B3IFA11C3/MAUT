<?php

function login_get_data()
{
	return isset($_SESSION["user"]) ? $_SESSION["user"] : false;
}

function render_main_block($state="", $redirect_path="")
{
	$content = '<section id="login">
            <div class="container" style="width: 400px">
                <div class="row">
                        <div class="form-wrap">
                        <h1><img src="../img/logo.png" width="150px" /></h1>
                            <form role="form" method="post" action="/login" id="login-form" autocomplete="off">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Benutzername">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Passwort">
                                </div>';

	if($redirect_path != "")
		$content .= '<input type="hidden" name="path" value="' . htmlentities($redirect_path) . '"/>';

	$content .= '<input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Anmelden">    
                            </form>';
	if($state == "success")
		$content .= '<div class="alert alert-success" role="alert"><center>Erfolgreich abgemeldet.</center></div>';
	else if($state == "error")
		$content .= '<div class="alert alert-danger" role="alert"><center><b>Fehler!</b> Anmeldedaten sind nicht korrekt.</center></div>';
		
	$content .= '</div>
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>';

	return $content;
}

function login_show_login($path)
{
	if(login_get_data() !== false)
		return false;

	page_render(render_main_block("", $path), false);
	return true;
}

function login_login($path)
{
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$_SESSION["user"] = array("asdf");

	if(login_get_data() !== false)
	{
		render_path($_POST["path"]);
	}
	else
		page_render(render_main_block("error", $_POST["path"]), false);

	return true;
}

function login_logout($path)
{
	if(login_get_data() !== false)
	{
		unset($_SESSION["user"]);
		$state = "success";
	}
	else
		$state = "error";

	page_render(render_main_block($state), false);
	return true;
}

maut_register_path("#^login\$#", login_login);
maut_register_path("#.*#", login_show_login);
maut_register_path("#^logout\$#", login_logout);

return true;
?>
