<?php
namespace model;
//Dependencies
require_once('./src/model/m_songList.php');

class Instrument {
	private $instrumentID;
	private $name;
	private $songs;
	private $totalPracticetime;
	
	/**
	 * Constructor containing mocked overloading in PHP.  //TODO is songs used?
	 */
	public function __construct($name, SongList $songs = null, $instrumentID = null) {
	
		if ($instrumentID == null) {
			$this->instrumentId = 0;
		}
		else {
			$this->instrumentID =$instrumentID;
		}
		//$this->$instrumentId = ($instrumentId == null) ? 0 : $instrumentId;
		$this->songs = ($songs == null) ? new SongList(): $songs;
		$this->name = $name;
	}

	/**
	 * @return String
	 */
	public function getName() {
		return $this->name; //TODO - make this return instrument details ? Name, surname , personal code number, 	
	}

	/**
	 * @return String
	 */
	public function getInstrumentID() {
		return $this->instrumentID;
	}
	
	/**
	 * @return Void
	 */
	public function setInstrumentID($instrumentID) {  // TODO check if used in repository
		$this->instrumentID = $instrumentID;
	}
	
	/**
	 * Add a new song to the instrument.
	 * 
	 * @param \model\Song $song Instance of the populated song to add. 
	 * @return Void
	 */
	public function add(\model\Song $song) {
		$this->songs->add($song);
	}
	
	/**
	 * @return \model\SongList
	 */
	public function getSongs() {
		return $this->songs;
	}
	
	public function setTotalPracticeTime($totalPracticetime) {
		
		$this->totalPracticetime = $totalPracticetime;
	}
	
	public function getTotalPracticeTime() {
			
		$seconds = $this->totalPracticetime;
		$hours = floor($seconds / 3600);
		$minutes = floor(($seconds / 60) % 60);
		$seconds = $seconds % 60;
		
		return sprintf("%2d hours and  %2d:%02d min", $hours, $minutes, $seconds);
	}
}