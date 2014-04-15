package delta.bg.training.tasks.scheduler;

import java.util.Scanner;
import java.util.LinkedList;



public class Scheduler {
	private static boolean[] workdays;
	private static int numWorkplaces;
	private static int numEmployees;
	private static int numShifts;
	private static int workdayStart;
	private static int workdayEnd;
	private static int hoursInShift;
	private static int breakBetweenShifts;
	private static int minWorkHours;
	private static int maxWorkHours;
	private static int [] shiftStart; // start hour of every shift (Ex. shiftStart[0] - start hour of shift 1, shiftStar[1] - start hour of shift 2)
	private static int[][][] occupiedWorkplace;	// occupiedWorkplace[day][shift number][work place number] 
	private static LinkedList<Employee> employees;	
	private static Scanner sc = new Scanner(System.in);
	private static int i;
	
	static{
		System.out.println("WELCOME!");
		workdays = new boolean[7];
		for(i=0;i<7;i++){
			switch(i){
				case 0: System.out.print("Is monday a workday (Y/N)?: ");
						break;
				case 1: System.out.print("Is tuesday a workday (Y/N)?: ");
						break;
				case 2: System.out.print("Is wednesday a workday (Y/N)?: ");
						break;
				case 3: System.out.print("Is thursday a workday (Y/N)?: ");
						break;
				case 4: System.out.print("Is friday a workday (Y/N)?: ");
						break;
				case 5: System.out.print("Is saturday a workday (Y/N)?: ");
						break;
				case 6: System.out.print("Is sunday a workday (Y/N)?: ");
						break;
				default:System.out.print("Error");
			}
			while(true){
				String answer = sc.nextLine();
				if(answer.equalsIgnoreCase("Y")){
					workdays[i] = true;
					break;
				}
				else if(answer.equalsIgnoreCase("N")){
					workdays[i] = false;
					break;
				}
				else{
					System.out.println("Please answer with Y or N!");
				}
			}
		}
		System.out.print("Enter the number of the workplaces: ");
		while(true){
			numWorkplaces = sc.nextInt();
			if(numWorkplaces<=0){
				System.out.print("The number must be positive!\nEnter again: ");
			}
			else
				break;
		}
		System.out.print("Enter the number of the employees: ");
		while(true){
			numEmployees = sc.nextInt();
			if(numEmployees<=0){
				System.out.print("The number must be positive!\nEnter again: ");
			}
			else
				break;
		}
		System.out.print("Enter the number of the shifts: ");
		while(true){
			numShifts = sc.nextInt();
			if(numShifts<=0){
				System.out.print("The number must be positive!\nEnter again: ");
			}
			else if(numShifts>24){
				System.out.print("The number must be less than 24, or at most 24!\nEnter again: ");
			}
			else
				break;
		}
		System.out.print("Enter the workday start hour: ");
		while(true){
			workdayStart = sc.nextInt();
			if(workdayStart<0){
				System.out.print("The number must be positive or 0!\nEnter again: ");
			}
			else if(workdayStart>24){
				System.out.print("The number must be less than 24, or at most 24!\nEnter again: ");
			}
			else
				break;
		}
		System.out.print("Enter how many hours is one shift: ");
		while(true){
			int countErr = 0;
			hoursInShift = sc.nextInt();
			if(hoursInShift<1){
				System.out.print("There is at least 1 hour in shift!\nEnter again: ");
				countErr++;
			}
			if(hoursInShift>8){
				System.out.print("There cannot be more than 8 hours in shift!\nEnter again: ");
				countErr++;
			}
			if((numShifts*hoursInShift + workdayStart) > 24){
				System.out.print("The number of shifts and the hours in shift cannot be completed in a workday!\nEnter again: ");
				countErr++;
			}
			if(countErr == 0)
				break;
		}
		System.out.print("Enter the break between shifts: ");
		while(true){
			int countErr = 0;
			breakBetweenShifts = sc.nextInt();
			if(breakBetweenShifts<0){
				System.out.print("The number must be positive or 0!\nEnter again: ");
				countErr++;
			}
			if(breakBetweenShifts>=24){
				System.out.print("The number must be less than 24!\nEnter again: ");
				countErr++;
			}
			if((numShifts*hoursInShift + (numShifts - 1)*breakBetweenShifts + workdayStart) > 24){
				System.out.print("The number of shifts and the hours in shift cannot be completed in a workday!\nEnter again: ");
				countErr++;
			}
			if(countErr == 0)
				break;
		}
		System.out.print("Enter the workday end hour: ");
		while(true){
			int countErr = 0;
			workdayEnd = sc.nextInt();
			if(workdayEnd<=workdayStart){
				System.out.print("The end of the workday must be after the start!\nEnter again: ");
				countErr++;
			}
			if(workdayEnd>24){
				System.out.print("The number must be less than 24, or at most 24!\nEnter again: ");
				countErr++;
			}
			if(workdayEnd<(workdayStart + (numShifts*(hoursInShift+breakBetweenShifts)) - breakBetweenShifts)){
				System.out.print("The value is not possible - the number of shifts is too big!\nEnter again: ");
				countErr++;
			}
			if(countErr == 0)
				break;
		}
		System.out.print("Enter the minimum hours every employee must have (for 2 work weeks): ");
		while(true){
			minWorkHours = sc.nextInt();
			if(minWorkHours<=0){
				System.out.print("The number must be positive!\nEnter again: ");
			}
			else if(minWorkHours>(14*8)){
				System.out.print("Work Hours cannot be more than the legal value!\nEnter again: ");
			}
			else
				break;
		}
		System.out.print("Enter the maximum hours every employee must have (for 2 work weeks): ");
		while(true){
			maxWorkHours = sc.nextInt();
			if(maxWorkHours<minWorkHours){
				System.out.print("The number you entered is less than the minimum hours!\nEnter again: ");
			}
			else if(maxWorkHours>(14*8)){
				System.out.print("Work Hours cannot be more than the legal value!\nEnter again: ");
			}
			else
				break;
		}
		shiftStart = new int[numShifts];
		for(i=0;i<numShifts;i++){
			shiftStart[i] = workdayStart + (hoursInShift + breakBetweenShifts) * i;
		}
		occupiedWorkplace = new int[14][numShifts][numWorkplaces];
		for(int j=0;j<14;j++)
			for(int k=0;k<numShifts;k++)
				for(int l=0;l<numWorkplaces;l++)
					occupiedWorkplace[j][k][l] = 0;
		employees = new LinkedList <Employee>();
		for(i=0;i<numEmployees;i++){
			employees.add(new Employee(i+1,"Employee"));
		}
	}
		
	public static boolean[] getWorkdays() {
		return workdays;
	}

	public static void setWorkdays(boolean[] workdays) {
		if (workdays.length == 7) {
			Scheduler.workdays = workdays;
		}
	}

	public static int getNumWorkplaces() {
		return numWorkplaces;
	}

	public static void setNumWorkplaces(int numWorkplaces) {
		if (numWorkplaces >= 1) {
			Scheduler.numWorkplaces = numWorkplaces;
		}
	}

	public static int getNumEmployees() {
		return numEmployees;
	}

	public static void setNumEmployees(int numEmployees) {
		if (numEmployees >= 1) {
			Scheduler.numEmployees = numEmployees;
		}
	}

	public static int getWorkdayStart() {
		return workdayStart;
	}

	public static void setWorkdayStart(int workdayStart) {
		if (workdayStart > 0 && workdayStart < 24) {
			Scheduler.workdayStart = workdayStart;
		}
	}

	public static int getWorkdayEnd() {
		return workdayEnd;
	}

	public static void setWorkdayEnd(int workdayEnd) {
		if (workdayEnd > 0 && workdayEnd < 24) {
			Scheduler.workdayEnd = workdayEnd;
		}
	}

	public static int getNumShifts() {
		return numShifts;
	}

	public static void setNumShifts(int numShifts) {
		if (numShifts >= 1) {
			Scheduler.numShifts = numShifts;
		}
	}

	public static int getHoursInShift() {
		return hoursInShift;
	}

	public static void setHoursInShift(int hoursInShift) {
		if (hoursInShift >= 1 && hoursInShift < 24) {
			Scheduler.hoursInShift = hoursInShift;
		}
	}

	public static int getBreakBetweenShifts() {
		return breakBetweenShifts;
	}

	public static void setBreakBetweenShifts(int breakBetweenShifts) {
		if (breakBetweenShifts > 0 && breakBetweenShifts < 24) {
			Scheduler.breakBetweenShifts = breakBetweenShifts;
		}
	}	

	public static int[] getShiftStart() {
		return shiftStart;
	}

	public static void setShiftStart(int[] shiftStart) {
		Scheduler.shiftStart = shiftStart;
	}

	public static int[][][] getOccupiedWorkplace() {
		return occupiedWorkplace;
	}

	public static void setOccupiedWorkplace(int[][][] occupiedWorkplace) {
		Scheduler.occupiedWorkplace = occupiedWorkplace;
	}

	public static LinkedList<Employee> getEmployees() {
		return employees;
	}

	public static void setEmployees(LinkedList<Employee> employees) {
		Scheduler.employees = employees;
	}

	public static int getMinWorkHours() {
		return minWorkHours;
	}

	public static void setMinWorkHours(int minWorkHours) {
		if (maxWorkHours > 0) {
			if (minWorkHours <= maxWorkHours) {
				Scheduler.minWorkHours = minWorkHours;
			}
		}
	}

	public static int getMaxWorkHours() {
		return maxWorkHours;
	}

	public static void setMaxWorkHours(int maxWorkHours) {
		if (maxWorkHours > minWorkHours && maxWorkHours <= 80) {
			Scheduler.maxWorkHours = maxWorkHours;
		}
	}
	
	public static void arrangeHours(int day){
		int result;
		LinkedList<Employee> employeesTemp = sortEmployeesByFreeTimeInDay(employees, day);
		for(int i=0;i<numEmployees;i++){
			for(int j=0;j<numShifts;j++){
				if(employeesTemp.get(i).getAvailableShifts()[day][j]){
					result = enrollEmployee(employeesTemp.get(i), day, j);
					if(result == 0)
						break;
				}
			}
		}
	}

	// find the workplaces in the current shift that are occupied
	private static int getEmployeesCountInShift(int day, int shift){
		int occupiedCount = 0;
		for (int workplace = 0; workplace < numWorkplaces; workplace++) {
			if (occupiedWorkplace[day][shift][workplace] != 0) {
				occupiedCount++;
			}
		}
		return occupiedCount;
	}	
	
	public static void addMoreHours(int day){
		for (int shift = 0; shift < numShifts; shift++) {
			addMoreHoursForShift(day, shift);
		}	
	}

	private static void addMoreHoursForShift(int day, int shift) {
		int occupiedCount = getEmployeesCountInShift(day, shift);
		
		if (occupiedCount < numWorkplaces) {
			LinkedList<Employee> orderedByFreeTime = sortEmployeesByFreeTimeInDay(employees, day);
			for (int i =  orderedByFreeTime.size() - 1; i >= 0; i--) {
				Employee emp = orderedByFreeTime.get(i);
				if (emp.getWorkShifts()[day][shift] == 0 && emp.getAvailableShifts()[day][shift]) {
					enrollEmployee(emp, day, shift);
					addMoreHoursForShift(day,shift);
					break;
				}
			}
		}
	}
	
	private static int enrollEmployee(Employee employee, int day, int shift) {
		for (int workPlaceNum = 0; workPlaceNum < numWorkplaces; workPlaceNum++) { // the shift (1-2, or in the arrray 0-1)
			if (occupiedWorkplace[day][shift][workPlaceNum] == 0 && employee.getWorkShifts()[day][shift] == 0) {
				employee.getWorkShifts()[day][shift] = workPlaceNum + 1;
				employee.getAvailableHours()[day] -= Scheduler.hoursInShift;
				occupiedWorkplace[day][shift][workPlaceNum] = employee.getId();
				employee.setWorkHours(employee.getWorkHours() + hoursInShift);
				return 0;
			}
		}
		return 1;
	}
	
	private static int dismissEmployee(Employee employee, int day, int shift){
		for(int workPlaceNum = 0; workPlaceNum < numWorkplaces; workPlaceNum++){
			if(occupiedWorkplace[day][shift][workPlaceNum] == employee.getId()){
				employee.getWorkShifts()[day][shift] = 0;
				employee.getAvailableHours()[day] += Scheduler.hoursInShift;
				occupiedWorkplace[day][shift][workPlaceNum] = 0;
				employee.setWorkHours(employee.getWorkHours() - hoursInShift);
				return 0;
			}
		}
		return 1;
	}

	private static LinkedList<Employee> sortEmployeesByFreeTimeInDay(
			LinkedList<Employee> employees, int day) {
		int currentFreeHours, nextFreeHours;
		LinkedList<Employee> orderedEmployees = new LinkedList<Employee>(employees);
		for (int i = 0; i < orderedEmployees.size(); i++) {
			currentFreeHours = orderedEmployees.get(i).getAvailableHours()[day];
			for (int j = i + 1; j < orderedEmployees.size(); j++) {
				nextFreeHours = orderedEmployees.get(j).getAvailableHours()[day];
				if (currentFreeHours > nextFreeHours) {
					Employee swap = orderedEmployees.get(i);
					orderedEmployees.set(i, orderedEmployees.get(j));
					orderedEmployees.set(j, swap);
					currentFreeHours = nextFreeHours;
				}
			}
		}
		return orderedEmployees;
	}
	
	private static LinkedList<Employee> sortEmployeesByWorkHours(
			LinkedList<Employee> employees) {
		int currentWorkHours, nextWorkHours;
		LinkedList<Employee> orderedEmployees = new LinkedList<Employee>(employees);
		for (int i = 0; i < orderedEmployees.size(); i++) {
			currentWorkHours = orderedEmployees.get(i).getWorkHours();
			for (int j = i + 1; j < orderedEmployees.size(); j++) {
				nextWorkHours = orderedEmployees.get(j).getWorkHours();
				if (currentWorkHours > nextWorkHours) {
					Employee swap = orderedEmployees.get(i);
					orderedEmployees.set(i, orderedEmployees.get(j));
					orderedEmployees.set(j, swap);
					currentWorkHours = nextWorkHours;
				}
			}
		}
		return orderedEmployees;
	}
 
	public static void rearrangeAveraging(){
		int result = -1;
		LinkedList<Employee> employeesTemp = new LinkedList<Employee>();
		int indexOfEmployeeWithLeastWorkHours = 0;
		int indexOfEmployeeWithMostWorkHours = numEmployees - 1;
		long time1 = System.currentTimeMillis();
		long time2;
		while(true){
			employeesTemp = sortEmployeesByWorkHours(employees);
			while(result != 0){
				result = exchangeHours((employeesTemp.get(indexOfEmployeeWithLeastWorkHours).getId()-1), (employeesTemp.get(indexOfEmployeeWithMostWorkHours).getId()-1));
				if(result != 0) indexOfEmployeeWithMostWorkHours--;
				if(indexOfEmployeeWithLeastWorkHours >= indexOfEmployeeWithMostWorkHours){
					indexOfEmployeeWithLeastWorkHours++;
					indexOfEmployeeWithMostWorkHours = numEmployees - 1;
				}
				if(indexOfEmployeeWithLeastWorkHours >= (numEmployees - 2)){
					return;
				}
			}
			result = -1;
			time2 = System.currentTimeMillis();
			if(time2 - time1 >= 5000)
				break;
		}
		System.out.println("DONE!");
	}
	
	public static int exchangeHours(int indexOfRecipient, int indexOfDonor){
		int result1 = -1;
		int result2 = -1;
		for(int i=0;i<14;i++){
			for(int j=0;j<numShifts;j++){
				if(employees.get(indexOfRecipient).getAvailableShifts()[i][j] && employees.get(indexOfRecipient).getWorkShifts()[i][j] == 0 && employees.get(indexOfDonor).getWorkShifts()[i][j]>0){
					result1 = dismissEmployee(employees.get(indexOfDonor), i, j);
					if(result1 == 0){
						result2 = enrollEmployee(employees.get(indexOfRecipient), i, j);
						if(result2 ==0)
							return 0;
						else{
							enrollEmployee(employees.get(indexOfDonor), i, j);
						}
					}
				}
			}
		}
		return 1;
	}
	
	public static void dismissHours(){
		int countShifts;
		int result;
		int shift;
		for(Employee em : employees){
			if(em.getWorkHours() > maxWorkHours){
				for(int i=0;i<14;i++){
					countShifts=0;
					for(int j=0;j<numShifts;j++){
						if(em.getWorkShifts()[i][j]>0){
							countShifts++;
						}
					}
					if(countShifts > 1){
						shift=0;
						while(true){
							result = dismissEmployee(em, i, shift);
							shift++;
							if(result == 0)
								break;
						}
					}
					if(em.getWorkHours() <= maxWorkHours)
						break;
				}
			}
		}
	}
}