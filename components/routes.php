<?php
/*

 */

Router::setHelpFunc("auth",function(){
	return User::is_auth();
});

// Router::any("/","IndexControler@actionIndex","auth");
// Router::any("/{id}","IndexControler@actionIndex","auth");

Router::any("/","TestControler@indexAction");
Router::get("/get/{id}","TestControler@indexGET");
Router::post("/post","TestControler@indexPOST");
