<?php   //http://stackoverflow.com/questions/8310487/start-and-stop-a-timer-php  
namespace model;
 
class Timer {

   var $start     = 0;
   var $stop      = 0;
   var $elapsed   = 0;


   // Start the counting time
   function start() {
      $this->start =  $this->_gettime();// $_SERVER["REQUEST_TIME_FLOAT"];  //TODO not request time float
   }

   // Stop counting time
   function stop() {
      $this->stop  = $this->_gettime();
      $this->elapsed = $this->_compute();
   }

   // Get Elapsed Time
   function elapsed() {
 
	  if ( !$this->elapsed )
         $this->stop();

      return $this->elapsed;
   }

   // Resets Timer so it can be used again
   function reset() {
      $this->start   = 0;
      $this->stop    = 0;
      $this->elapsed = 0;
   }

	function microtime_float()
{
     list($usec, $sec) = explode(" ", microtime());
     return ((float)$usec + (float)$sec);
}
//$time = $time_end - $time_start;

   #### PRIVATE METHODS ####

  //Get Current Time
   function _gettime() {
      return  $this->microtime_float();
   }

  //Compute elapsed time
   function _compute() {
      return $this->stop - $this->start;
   }
}
