<?php   
namespace model;
/*
 * Är medveten om att denna klass stinker ! Är helt onödig som den är just nu...
 * borde gjort det helt annorlunda men jag hade för tajt med tid!!! 
 */ 
 
class Timer {

   var $start     = 0;
   var $stop      = 0;
   var $elapsed   = 0;

   // Start the counting time
   function start() {
     return $this->_gettime();// $_SERVER["REQUEST_TIME_FLOAT"];  //TODO not request time float
   }

   // Stop counting time
   function stop() {
      return $this->_gettime();
   }

	function microtime_float()
{
     list($usec, $sec) = explode(" ", microtime());
     return ((float)$usec + (float)$sec);
}
//$time = $time_end - $time_start;

  //Get current Time
   function _gettime() {
      return  $this->microtime_float();
   }

}
