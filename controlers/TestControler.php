<?php
	/**
	 *  
	 */
	class TestControler
	{
		
		public function indexAction()
		{
			echo "Test";	
		}

		public function indexGET($id){
			echo $id;
		}
	}