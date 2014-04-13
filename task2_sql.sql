/*Database SQL for Delta-Task 2 */
create database Delta_Task2;
use Delta_Task2;

/*Create tables */
create table Shifts
(
	id INT NOT NULL auto_increment PRIMARY KEY,
	Day INT NOT NULL,
	Start INT NOT NULL,
	End INT NOT NULL
);

create table EmployeeShifts
(
	Employee_id INT NOT NULL auto_increment,
	Shift_id INT NOT NULL,
        is_available bool NOT NULL,
        is_taken bool NOT NULL,
        FOREIGN KEY (Shift_id) REFERENCES Shifts(id),
	PRIMARY KEY (Employee_id,Shift_id)
);

create table Employees
(
	id INT NOT NULL auto_increment PRIMARY KEY,
	Name VARCHAR(15) NOT NULL
);

create table EmployeeFreeTimes
(
	id INT NOT NULL auto_increment PRIMARY KEY,
	Employee_id INT NOT NULL,
	Day INT NOT NULL,
	Start INT NOT NULL,
	End INT NOT NULL,
	FOREIGN KEY (Employee_id) REFERENCES EmployeeShifts(Employee_id)
);
