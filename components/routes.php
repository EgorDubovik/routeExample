<?php
/*

 */

Router::setHelpFunc("auth",function(){
	return User::is_auth();
});

// Router::any("/","IndexControler@actionIndex","auth");
// Router::any("/{id}","IndexControler@actionIndex","auth");

Router::any("/","TestControler@indexAction");
