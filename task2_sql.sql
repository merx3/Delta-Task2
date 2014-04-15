/*Database SQL for Delta-Task 2 */
create database delta_task2;
use delta_task2;

/*Create tables */
create table shifts
(
	shift_id INT NOT NULL auto_increment PRIMARY KEY,
	day INT NOT NULL,
	start INT NOT NULL,
	end INT NOT NULL
);

create table employee_shifts
(
	employee_id INT NOT NULL,
	shift_id INT NOT NULL,
        is_available bool NOT NULL,
        is_taken bool NOT NULL,
        FOREIGN KEY (shift_id) REFERENCES Shifts(shift_id),
        FOREIGN KEY (employee_id) REFERENCES Employees(employee_Id),
	PRIMARY KEY (employee_id,shift_id)
);

create table employees
(
	employee_id INT NOT NULL auto_increment PRIMARY KEY,
	name VARCHAR(255) NOT NULL
);

create table employee_free_times
(
	employee_free_time_id INT NOT NULL auto_increment PRIMARY KEY,
	employee_id INT NOT NULL,
	day INT NOT NULL,
	start INT NOT NULL,
	end INT NOT NULL,
	FOREIGN KEY (employee_id) REFERENCES employees(employee_id)
);
