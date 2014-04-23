<?php
require_once('db_connection.php');
require_once('db_functions.php');
require_once('scheduler.php');
	// TODO:
	//	    readEmployeeDataFromDatabase($employee_id); 	
	// 	writeEmployeeScheduleToFile(String filename) -> this will be replaces with "generate employee schedule as html" or something simmilar
	//     setAvailableHoursAndAvailableShifts();
	
class Employee{
	private $id;
	private $name;
	private $workHours;
	private $startHours;
	private $endHours;
	private $availableHours;
	private $availableShifts;
	private $workShifts;
	public static $dbconn;
	
	function __construct(){		
	}	
        
        public static function constructEmployeeFromDb($employee_id){
            $employee = new Employee();
            if(!is_int($employee_id)){
                throw new Exception('id is not integer');
            }
            if($employee_id>0){
                $employee->setId($employee_id);
            }
            else{
                throw new Exception('id must be positive');
            }
            if(!isset(Employee::$dbconn)){
                Employee::$dbconn = Scheduler::getDBConnection();
            }
            $res = $employee->readEmployeeDataFromDatabase($employee_id);
            if($res != 0) {
                throw new Exception('couldn\'t read employee '.$employee_id.' from database');
            }
            return $employee;
        }
        
	public static function constructEmployee($employee_id, $name, $free_hours){
		$employee = new Employee();    
		if(!is_int($employee_id)){
			throw new Exception('id is not integer');
		}
		if (strlen($name) < 3) {
			throw new Exception("Name is too short.");
		}
		else{
			$employee->name = $name;
		}
		if (!is_array($free_hours)) {
			throw new Exception("Invalid free hours.");
		}
		if($employee_id>=0){
			$employee->id=$employee_id;
		}
		else{
			throw new Exception('id must be positive');
		}
		if(!isset(Employee::$dbconn)){
			Employee::$dbconn = Scheduler::getDBConnection();
		}
		
		$employee->workHours = 0;
		$employee->startHours = array();
		$employee->endHours = array();
				$employee->availableHours = array();
				
				
		for($i=0; $i<14; $i++){
			$employee->availableHours[$i] = 0;
			$employee->workShifts[$i] = array();
			if(is_int($free_hours[$i]['from']) && is_int($free_hours[$i]['to'])){ 
				$employee->startHours[$i] = $free_hours[$i]["from"];
				$employee->endHours[$i] = $free_hours[$i]["to"];	
			}
			else{
				throw new Exception('Invalid start/end hours in day '.$i);
			}	
		}
				
		$employee->setDefaultWorkShifts();
		$employee->setAvailableHoursAndAvailableShifts();
		$result = db_addEmployee(Employee::$dbconn, $employee);
				
		if($employee->id==0){
			$employee->id=$result;
		}
		return $employee;
	}

	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		if(!is_int($id)){
			throw new Exception('id is not integer');
		}
		if ($id>=1){
			$this->id = $id;
		}
		else {
			throw new Exception("Invalid ID number!");
		}
	}
	
	public function getName(){
		return $this->name;
	}

	public function setName($name){
		if(strlen($name)<3){
			throw new Exception('name must be at least 3 characters');
		}
		$this->name = $name;
	}

	public function getWorkHours(){
		return $this->workHours;
	}
	
	public function setWorkHours($hours){
		if(!is_int($hours)){
			throw new Exception('hours are not integer');
		}
		if ($hours>=0 && $hours<=(14*8)){
			$this->workHours = hours;
		}
		else if($hours<0){
			throw new Exception("Work Hours cannot be negative!");
		}
		else{
			throw new Exception("Work Hours cannot be more than the legal value!");
		}
	}
	
	public function &getStartHours() {
		return $this->startHours;
	}
	
	public function setStartHours($startHours) {		
		if(!is_array($startHours)){
			throw new Exception('startHours are not an array');
		}
		foreach($startHours as $startHour){
			if($startHour<0 || $startHour>24){
				throw new Exception("Hours are between 0 and 24!");
			}
		}
		$this->startHours = $startHours;
	}
	
	public function &getEndHours() {
		return $this->endHours;
	}
	
	public function setEndHours($endHours) {
		if(!is_array($endHours)){
			throw new Exception('endHours are not an array');
		}
		foreach($endHours as $endHour){
			if($endHour<0 || $endHour>24){
				throw new Exception("Hours are between 0 and 24!");
			}
		}
		$this->endHours = $endHours;
	}
	
	public function &getAvailableHours() {
		return $this->availableHours;
	}
	
	public function setAvailableHours($availableHours) {
		if(!is_array($availableHours)){
			throw new Exception('startHours are not an array');
		}
		foreach($availableHours as $availableHour){
			if($availableHour<0 || $availableHour>24){
				throw new Exception("Hours are between 0 and 24!");		
			}
		}
		$this->availableHours = $availableHours;
	}
	
	public function &getAvailableShifts() {
		return $this->availableShifts;
	}
	
	public function setAvailableShifts($availableShifts) {
		if(!is_array($availableShifts)){
			throw new Exception('availableShifts are not an array');
		}
		
		$this->availableShifts = $availableShifts;
	}
	
	public function &getWorkShifts() {
		return $this->workShifts;
	}	
	
	public function setWorkShifts($workShifts) {
		if(!is_array($workShifts)){
			throw new Exception('workShifts are not an array');
		}
		$this->workShifts = $workShifts;
	}
	
	public function setDefaultWorkShifts(){
		$this->workShifts = array();
		for($i=0;$i<14;$i++){
			$this->workShifts = array();
			for($j=0;$j<Scheduler::getNumShifts();$j++)
				$this->workShifts[$i][$j] = 0;
		}
	}
	
	public function setAvailableHoursAndAvailableShifts(){
		$shiftStartTmp = Scheduler::getShiftStart();
		for($i=0;$i<14;$i++){
			$this->availableHours[$i] = ($this->endHours[$i] - $this->startHours[$i]);
			for($j=0;$j<Scheduler::getNumShifts();$j++){
				if($this->startHours[$i] <= $shiftStartTmp[$j] && $this->endHours[$i] >= ($shiftStartTmp[$j] + Scheduler::getHoursInShift()))
					$this->availableShifts[$i][$j] = true;
				else	
					$this->availableShifts[$i][$j] = false;
			}
		}
	}	

	private function readEmployeeDataFromDatabase($id){
		$empl_shifts = db_getEmployeeShifts(Employee::$dbconn, $id);
		$this->name = db_getEmployeeName(Employee::$dbconn, $id);
		$empl_taken_shifts_by_day = array();
		if(is_array($empl_shifts)){
			foreach($empl_shifts as $shift){
				if ($shift["is_taken"]){
					$shift_day = $shift["day"];
					if (!is_array($empl_taken_shifts_by_day[$shift_day])){
						$empl_taken_shifts_by_day[$shift_day] = array(); 
					}
					$empl_taken_shifts_by_day[$shift_day][] = $shift;
				}
			}
		}

		$empl_free_time = db_getEmployeeFreeTime(Employee::$dbconn, $id);
		$empl_free_time_by_day = array();
		foreach($empl_free_time as $free_time){
			$day = $free_time["day"];			
			$empl_free_time_by_day[$day] = $free_time;
		}
	
		$this->workHours = 0;
		$this->startHours = array();
		$this->endHours = array();
		$this->workShifts = array();
                $this->availableHours = array();
		for($i=0; $i<14; $i++){
			$this->availableHours[$i] = 0;
			$this->workShifts[$i] = array();
			$shifts_in_day = Scheduler::getNumShifts();
			if(array_key_exists($i,$empl_free_time_by_day)){
				$this->startHours[$i] = $empl_free_time_by_day[$i]["start"];
				$this->endHours[$i] = $empl_free_time_by_day[$i]["end"];				
			}
			else {
				$this->startHours[$i] = 0;
				$this->endHours[$i] = 0;
			}

			for($j=0; $j<$shifts_in_day;$j++){
				if(array_key_exists($i,$empl_taken_shifts_by_day) && $empl_taken_shifts_by_day[$i]["shift_number"]==$j){
					$this->workShifts[$i][$j] = $empl_shifts_by_day[i]["seat_number"];
				}
				else {
					$this->workShifts[$i][$j] = 0;
				}
			}	
		}
	}
		
	public function getEmployeeSchedule(){
			$schedule = array();
			$schedule['messages'] = array();
			$schedule['employee_name'] = $this->getName();
			if ($this->workHours < Scheduler::getMinWorkHours()) {
				$out = "Couldn't schedule enough shifts for employee ".($this->getName()).'<br/>';
				$out .= "Hours scheduled for the two weeks: ".$this->workHours."(minimum required: ".Scheduler::getMinWorkHours().")<br/><br/>";
				$schedule['messages'][] = $out;
			}
			else{
				$out = "Hours scheduled for the two weeks for employee".$this->getName().": ".$this->workHours.'<br/><br/>';
				$schedule['messages'][] = $out;
			}
			for ($i = 0;$i < 14; $i++){
				$schedule[$i] = $this->getShifts($i);
			}
			return $schedule;
	}
	
	
	private function getShifts($day){
		$shifts = array();
		for ($i = 0;$i < Scheduler::getNumShifts(); $i++){
			if($this->workShifts[$day][$i] > 0){
				$shifts[] = $i;
			}
		}
		return $shifts;
	}
}


/*

<!-- ^^^^^^^^^ PHP -->

<!--
public class Employee{
	
	private int id;
	private int workHours;
	private int [] startHours;
	private int [] endHours;
	private int [] availableHours;
	private boolean [][] availableShifts;
	private int [][] workShifts;
	
	public Employee(int id, String filename){
		if(id>0) this.id=id;
		else return;
		workHours=0;
		int res = readEmployeeDataFromFile(filename+id+".in");//filename = Employee, id=4, FILE: Employee4.in
		if(res != 0) System.out.println("Error!");
		availableHours = new int[14];
		availableShifts = new boolean[14][Scheduler.getNumShifts()];
		setDefaultWorkShifts();
		setAvailableHoursAndAvailableShifts();
	}

	public int getId(){
		return this.id;
	}
	public void setId(int id){
		if (id>=1){
			this.id = id;
		}
		else {
			System.out.println("Invalid ID number!");
		}
	}
	
	public int getWorkHours(){
		return this.workHours;
	}
	public void setWorkHours(int hours){
		if (hours>=0 && hours<=(14*8)){
			this.workHours = hours;
		}
		else if(hours<0){
			System.out.println("Work Hours cannot be negative!");
		}
		else{
			System.out.println("Work Hours cannot be more than the legal value!");
		}
	}
	
	public int[] getStartHours() {
		return startHours;
	}
	public void setStartHours(int[] startHours) {
		for(int startHour : startHours){
			if(startHour<0 || startHour>24){
				System.out.println("Hours are between 0 and 24!");
				return;
			}
		}
		this.startHours = startHours;
	}
	
	public int[] getEndHours() {
		return endHours;
	}
	public void setEndHours(int[] endHours) {
		for(int endHour : endHours){
			if(endHour<0 || endHour>24){
				System.out.println("Hours are between 0 and 24!");
				return;
			}
		}
		this.endHours = endHours;
	}
	
	public int[] getAvailableHours() {
		return availableHours;
	}
	public void setAvailableHours(int[] availableHours) {
		for(int availableHour : availableHours){
			if(availableHour<0 || availableHour>24){
				System.out.println("Hours are between 0 and 24!");
				return;
			}
		}
		this.availableHours = availableHours;
	}
	
	public boolean[][] getAvailableShifts() {
		return availableShifts;
	}
	public void setAvailableShifts(boolean[][] availableShifts) {
		this.availableShifts = availableShifts;
	}
	
	public int[][] getWorkShifts() {
		return workShifts;
	}
	public void setWorkShifts(int[][] workShifts) {
		this.workShifts = workShifts;
	}
	
	public void setDefaultWorkShifts(){
		this.workShifts = new int[14][Scheduler.getNumShifts()];
		for(int i=0;i<14;i++)
			for(int j=0;j<Scheduler.getNumShifts();j++)
				this.workShifts[i][j] = 0;
	}
	
	public void setAvailableHoursAndAvailableShifts(){
		int [] shiftStartTmp = Scheduler.getShiftStart();
		for(int i=0;i<14;i++){
			availableHours[i] = (endHours[i] - startHours[i]);
			for(int j=0;j<Scheduler.getNumShifts();j++){
				if(startHours[i] <= shiftStartTmp[j] && endHours[i] >= (shiftStartTmp[j] + Scheduler.getHoursInShift()))
					availableShifts[i][j] = true;
				else
					availableShifts[i][j] = false;
			}
		}
	}
	
	public int readEmployeeDataFromFile(String filename){
		int counter = 0;
		int i=0;
		this.startHours = new int [14];
		this.endHours = new int [14];
		File file;
		Scanner reader;
		try{
			file = new File(filename);
			reader = new Scanner(file,"windows-1251");
			while (reader.hasNext())
			{
				String s = reader.nextLine();
				if (counter!=0&&counter%9!=0)
				{
					if (s.isEmpty()==false)
					{
						String[] splitted = s.split("[ ]");
						if(splitted.length == 1){//if the employee is unavailable in this day
							this.startHours[i] = 0;
							this.endHours[i++] = 0;
						}
						else{
							this.startHours[i] = Integer.parseInt(splitted[1]);
							this.endHours[i++] = Integer.parseInt(splitted[2]);
						}
					}
				}
				counter++;
			}
		}
		catch (FileNotFoundException fnf){
			System.out.println("File not found!"); return 1;
		}
		reader.close();
		return 0;
	}

	public int writeEmployeeScheduleToFile(String filename){
		PrintStream fileWriter;
		try{
			fileWriter = new PrintStream(filename,"windows-1251");
			if (this.workHours < Scheduler.getMinWorkHours()) {
				fileWriter.println("Couldn't schedule enough shifts to attend.");
				fileWriter.printf("Hours scheduled for the two weeks: %d(minimum required: %d)",this.workHours, Scheduler.getMinWorkHours());
				fileWriter.println();
			}
			else{
				fileWriter.printf("Hours scheduled for the two weeks: %d",this.workHours);
				fileWriter.println();
			}
			fileWriter.println("First Week");
			fileWriter.printf("Monday ");
			printSpec(0,fileWriter);
			fileWriter.println();
			fileWriter.printf("Tuesday ");
			printSpec(1,fileWriter);
			fileWriter.println();
			fileWriter.printf("Wednesday ");
			printSpec(2,fileWriter);
			fileWriter.println();
			fileWriter.printf("Thirsday ");
			printSpec(3,fileWriter);
			fileWriter.println();
			fileWriter.printf("Friday ");
			printSpec(4,fileWriter);
			fileWriter.println();
			fileWriter.printf("Saturday ");
			printSpec(5,fileWriter);
			fileWriter.println();
			fileWriter.printf("Sunday ");
			printSpec(6,fileWriter);
			fileWriter.println();
			fileWriter.println("Second Week");
			fileWriter.printf("Monday ");
			printSpec(7,fileWriter);
			fileWriter.println();
			fileWriter.printf("Tuesday ");
			printSpec(8,fileWriter);
			fileWriter.println();
			fileWriter.printf("Wednesday ");
			printSpec(9,fileWriter);
			fileWriter.println();
			fileWriter.printf("Thirsday ");
			printSpec(10,fileWriter);
			fileWriter.println();
			fileWriter.printf("Friday ");
			printSpec(11,fileWriter);
			fileWriter.println();
			fileWriter.printf("Saturday ");
			fileWriter.println();
			printSpec(12,fileWriter);
			fileWriter.println();
			fileWriter.printf("Sunday ");
			printSpec(13,fileWriter);
		}
		catch (FileNotFoundException fnf){
			System.out.println("File not found!"); return 1;
		}
		catch (UnsupportedEncodingException un){
			System.out.println("Unsupported Encoding!"); return 1;
		}
		fileWriter.close();
		return 0;
	}
	
	public void printSpec(int day,PrintStream fileWriter){
		for (int i = 0;i < Scheduler.getNumShifts(); i++){
			if(this.workShifts[day][i] > 0){
				fileWriter.printf("%d ",i+1);
			}
		}
	}
}-->
*/

?>