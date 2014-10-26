<?php
namespace model;
require_once("./src/helper/sessionHelper.php");

class Validation{
	
	private $sessionHelper;
	private $errorMessage;
	
	public function __construct(){
		$this->sessionHelper = new \helper\SessionHelper();
	}
	
	public function validateName($name){
		$safeName = $this->sessionHelper->makeSafe($name);		
		
		// If the provided name is empty
		 if (empty($name)) {
		      $this->errorMessage ="Input field can not be empty. ";
		 }
			
		//if not safe
		if ($name!= $safeName) {
   			$this->errorMessage = "The name has unsafe characters in it!";
		}
		
		//if errorMessage is empty- All is fine!
		if (empty($this->errorMessage)) {
			$this->sessionHelper->setName($safeName);
			return true;
		} else {
			$this->sessionHelper->setAlert($this->errorMessage);
			return false;
		}	
	}		
	
}
