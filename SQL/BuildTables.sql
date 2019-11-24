-- Uncommon Solutions Table Builds for HR System
-- Initiate with cleaning up tables from database
DROP TABLE UserGroupTable;
DROP TABLE ResumeTable;
DROP TABLE TrainingRecordTable;
DROP TABLE PersonnelRecordTable;
DROP TABLE PersonnelTable;
DROP TABLE ContactTable;
DROP TABLE GroupTable;
DROP TABLE JobTable;
DROP TABLE AccessLogTable;
DROP TABLE UserLoginTable;

-- Create primary table for the user account section of the database
CREATE TABLE UserLoginTable (
    user_number     INTEGER PRIMARY KEY,
    user_name       VARCHAR(25) NOT NULL,
    access_level    INTEGER NOT NULL,
    password_hash   VARCHAR(50) NOT NULL,
    last_login      DATETIME);

-- Create the table for storing login attempts per user name
-- Maintain referential integrity and wipe records if the associated user
-- Account entry no longer exists
CREATE TABLE AccessLogTable (
    time_stamp      DATE PRIMARY KEY,
    user_number     INTEGER NOT NULL,
    login_success   BOOLEAN NOT NULL,
    FOREIGN KEY (user_number)
		REFERENCES UserLoginTable(user_number)
        ON UPDATE CASCADE ON DELETE CASCADE);
    
-- Create table for storage of job titles/descriptions
CREATE TABLE JobTable (
    job_number              INTEGER PRIMARY KEY,
    position_name           VARCHAR(100) NOT NULL,
    position_description    VARCHAR(1000));
    
-- Create table to store different work group names
CREATE TABLE GroupTable (
    group_number    INTEGER PRIMARY KEY,
    group_name      VARCHAR(100) NOT NULL);

-- Create table for storing contact information, used for both 
-- Employees and emergency contacts
CREATE TABLE ContactTable (
    contact_number  INTEGER PRIMARY KEY,
    last_name       VARCHAR(50) NOT NULL,
    first_name      VARCHAR(50) NOT NULL,
    middle_name     VARCHAR(50),
    phone_number    VARCHAR(12) NOT NULL,
    address         VARCHAR(200),
    email           VARCHAR(100));

-- Create the primary personnel data table that ties to records in other
-- tables. Maintain referential integrity by cascading updates
CREATE TABLE PersonnelTable (
    employee_number             INTEGER PRIMARY KEY,
    user_number                 INTEGER NOT NULL,
    SSN                         VARCHAR(11),
    personal_contact_number     INTEGER NOT NULL,
    emergency_contact_number    INTEGER,
    job_number                  INTEGER,
	FOREIGN KEY (user_number)
		REFERENCES UserLoginTable(user_number)
        ON UPDATE CASCADE,
	FOREIGN KEY (personal_contact_number)
		REFERENCES ContactTable(contact_number)
        ON UPDATE CASCADE,
	FOREIGN KEY (emergency_contact_number)
		REFERENCES ContactTable(contact_number)
        ON UPDATE CASCADE,
	FOREIGN KEY (job_number)
		REFERENCES JobTable(job_number)
        ON UPDATE CASCADE);
    
-- Create table for storing personnel record information for personnel actions
CREATE TABLE PersonnelRecordTable (
    record_number   INTEGER PRIMARY KEY,
    record_date     DATE,
    event_record    VARCHAR(1000),
    employee_number INTEGER NOT NULL,
    FOREIGN KEY (employee_number)
		REFERENCES PersonnelTable(employee_number)
        ON UPDATE CASCADE);

-- Create table for storing trainign record information for individual employees
CREATE TABLE TrainingRecordTable (
    record_number   INTEGER PRIMARY KEY,
    record_date     DATE,
    record_content  VARCHAR(1000),
    employee_number INTEGER NOT NULL,
    FOREIGN KEY (employee_number)
		REFERENCES PersonnelTable(employee_number)
        ON UPDATE CASCADE);

-- Create table for storing resumes of employees stored by HR (utilizing BLOB)
CREATE TABLE ResumeTable (
    resume_number   INTEGER PRIMARY KEY,
    resume_date     DATE,
    resume_content  BLOB,
    employee_number INTEGER NOT NULL,
    FOREIGN KEY (employee_number)
		REFERENCES PersonnelTable(employee_number)
        ON UPDATE CASCADE);

-- Create referential relationship table to tie personnel to groups
-- This method allows multiple users per group and multiple groups
-- Per user.
CREATE TABLE UserGroupTable (
    group_number    INTEGER NOT NULL,
    employee_number INTEGER NOT NULL,
    FOREIGN KEY (employee_number)
		REFERENCES PersonnelTable(employee_number)
        ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (group_number)
		REFERENCES GroupTable(group_number)
        ON UPDATE CASCADE ON DELETE CASCADE);