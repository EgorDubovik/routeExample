<?php
	/**
	 *  
	 */
	class TestControler
	{
		
		public function indexAction()
		{
			Response::view('testtemplate.html');	
		}

		public function indexGET($id){
			echo $id;
		}
	}