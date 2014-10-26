<?php
  namespace view;

  require_once("src/controller/c_signIn.php");
  require_once("src/helper/CookieStorage.php");
  require_once("src/helper/sessionHelper.php");
  require_once("src/helper/FileStorage.php");

  class SignIn {
    private $model;
    private $cookieStorage;
    private $sessionHelper;
	private $fileStorage;
	public static $getAction = "action"; 
	
	//Sign in/out
	public static $actionSignIn = 'signIn';
	public static $actionSignOut = "signOut";
	
    // names for the inputs & buttons used in the html-forms
	private static $uniqueID  = "SignIn::UniqueID";
	private static $signInBtn  = "SignIn:signInBtn";
	private static $rememberUser = "rememberUser";
	private static $username = "SignIn::Username";
	private static $password = "SignIn::Password";


    public function __construct(\model\SignIn $model) {
      $this->model = $model;
      $this->cookieStorage = new \helper\CookieStorage();
	  $this->fileStorage = new \helper\FileStorage();
      $this->sessionHelper = new \helper\SessionHelper(); 
    }
	
		/**
	 * Checks if user has navigated to sign in page
	 * 
	 * @return bolean
	 */
	public static function hasUserChosenSignInpage() {
		if (isset($_GET[self::$getAction])){
			if( $_GET[self::$getAction] == self::$actionSignIn) 
			return true;
		}
		return false;   
	}
		
	public function SignOutAttempt() {  
		if (isset($_GET[self::$getAction])) {
			if($_GET[self::$getAction] == self::$actionSignOut)
			return true;
		}
		return false;
	}
	
	/**
	 * @return array with formdetails (username, password)
	 */
	public function getFormData() {
		if (isset($_POST[self::$username])) {
			$remember = false;	
			if (isset($_POST[self::$username])) {
			$remember = true;
			}
			return array($_POST[self::$username], $_POST[self::$password], $remember ); //TODO return object
		}
		
		return NULL;
	}
  /**
      * Homepage - a view for users that are not logged in.
      *
      * @return string - Homepage
      */
    public function showHomepage() {
	  $html  = "<div id='homepage'>";
	  $html  = "<div id='startMessage'>";
      $html .= "<h2>Welcome to Music Logbook!</h2>";
	  $html .= "<p>A perfect place to keep track of your <br /> favourite songs and progress!</p>";
	  $html .= "</div>";
	  $html .= "<div class='successMessage'><p>".$this->sessionHelper->getAlert() ."</p></div>";
	  $html .= "<a href='?".self::$getAction."=".NavigationView::$actionSignUp."' id='signUp'>Sign up</a>"; 
	  $html .= "<a href='?".self::$getAction."=".self::$actionSignIn."' id='signIn'>Sign in</a>";  
	  $html .= "<div id='musicbar'><div id='treble'></div><ul>
	  			<li>Keep track of your practicing hours!</li>
	  			<li>Remember all your favourite songs!</li>
	  			<li>Rate your own progress!</li>
	  			<li>Efficiency when playing your instrument!</li>
	  			</ul></div>";  
	  $html .= "</div>";

      return $html;
    }

    /**
      * A view for users that wants to signIn
      *
      * @return HTML - The page log in page
      */
    public function showSignIn() {
	  $username =  $this->sessionHelper->getCreatedUsername();
	 
	  if (empty($username))
	    $username = empty($_POST[self::$username]) ? '' : $_POST[self::$username];
	 
	  $html  = "<div id='signInView'>";
      $html .= "<h2>Sign in</h2>";

      $html .= "
	  <form action='?" . self::$getAction . "=" . self::$actionSignIn ."' method='post'>";
	  $html .=  "<input type='text' name='". self::$username . "' placeholder='Username' value='".$username."' maxlength='30'>
	    <input type='password' name='". self::$password. "' placeholder='Password' value='' maxlength='30'>
	    <input type='checkbox' id='". self::$rememberUser. "' name='". self::$rememberUser. "' >
	    <p>Remember me</p>
	    <input type='submit' value='Sign in' name='". self::$signInBtn. "' id='submit'>
	  </form>"; 
	  $html .= "<div class='errorMessage'><p>".$this->sessionHelper->getAlert() ."</p></div>";
	  $html .= "</div>";

      return $html;
    }

	
	public function SignOut(){
		 if ($this->cookieStorage->isCookieSet(self::$uniqueID)) {
        
		  // Destroy all cookies
          $this->destroyCookies();
		  
		  // Remove the cookie file
          $this->fileStorage->removeFile($this->cookieStorage->getCookieValue(self::$uniqueID)); 
		return true;
        }
		return false;
	}
	
	public function destroyCookies(){
		
		// Destroy all cookies
          $this->cookieStorage->destroy(self::$uniqueID);
          $this->cookieStorage->destroy(self::$username);
          $this->cookieStorage->destroy(self::$password);
		
	}

	public function rememberUser(){
		if (isset($_POST[self::$rememberUser]))
        return true;

      return false;	
	}	
	
	public function getUsernameInput(){
			return $this->sessionHelper->makeSafe($_POST[self::$username]);
	}
	
	public function getPasswordInput(){
			return $this->sessionHelper->makeSafe($_POST[self::$password]);
	}		
	
	public function setCookies($postRemember) {
	 // Make the inputs safe to use in the code
     	$un = $this->getUsernameInput();   
    	$pw =  $this->getPasswordInput();
		 // If $postRemember got a value then set a cookie
        if ($postRemember) {
        
          $this->cookieStorage->save(self::$uniqueID, $_SESSION[self::$uniqueID], true);
          $this->cookieStorage->save(self::$username, $un);  
          $this->cookieStorage->save(self::$password, $this->sessionHelper->encryptString($pw));

          $this->sessionHelper->setAlert("Inloggning lyckades och vi kommer ihåg dig nästa gång");
        } 
	}
	public function getUsernameCookie() {
		return $this->cookieStorage->getCookieValue(self::$username);
	}
	public function getPasswordCookie() {
		return $this->cookieStorage->getCookieValue(self::$password);
	}
	
    public function checkCookies() {
    	//TODO need to validate cookie with database??maybe not..
	// $this->cookieStorage->getCookieValue(self::$username) === $this->getUsernameInput() &&
       // $this->cookieStorage->getCookieValue(self::$password) === $this->sessionHelper->encryptString($this->getPasswordInput()))
  
    if ($this->cookieStorage->isCookieSet(self::$uniqueID)) {
        	
        // Check if uniqid is valid from right browser //TODO set uniqueID is based on browser-detail
        if ($this->cookieStorage->getCookieValue(self::$uniqueID) === $this->sessionHelper->setUniqueID() )
         {
		  
	          // Check if the uniqid cookie is valid and not time-manipulated
	          if (!$this->cookieStorage->isCookieValid($this->cookieStorage->getCookieValue(self::$uniqueID))) {
	          	
	            // Destroy all cookies
         		 $this->destroyCookies();
	
	            // Set an alert
	            $this->sessionHelper->setAlert("Wrong information in cookie.");
	            return false;
	          }

	          return true;
			 }
      	   else {
          // Destroy all cookies
          $this->cookieStorage->destroy(self::$uniqueID);
          $this->cookieStorage->destroy(self::$username);
          $this->cookieStorage->destroy(self::$password);
		  
          // Set an alert
          $this->sessionHelper->setAlert("Wrong information in cookie.");
          return false;
        }
      } else {
        return false;
      }
     }

  }
