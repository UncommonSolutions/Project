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


CREATE TABLE UserLoginTable (
    user_number     INTEGER PRIMARY KEY,
    user_name       VARCHAR(25) NOT NULL,
    access_level    INTEGER NOT NULL,
    password_hash   VARCHAR(50) NOT NULL,
    last_login      DATE);

CREATE TABLE AccessLogTable (
    time_stamp      DATE PRIMARY KEY,
    user_number     INTEGER NOT NULL,
    login_success   BOOLEAN NOT NULL,
    FOREIGN KEY (user_number)
		REFERENCES UserLoginTable(user_number)
        ON UPDATE CASCADE ON DELETE CASCADE);
    
CREATE TABLE JobTable (
    job_number              INTEGER PRIMARY KEY,
    position_name           VARCHAR(100) NOT NULL,
    position_description    VARCHAR(1000));
    
CREATE TABLE GroupTable (
    group_number    INTEGER PRIMARY KEY,
    group_name      VARCHAR(100) NOT NULL);

CREATE TABLE ContactTable (
    contact_number  INTEGER PRIMARY KEY,
    last_name       VARCHAR(50) NOT NULL,
    first_name      VARCHAR(50) NOT NULL,
    middle_name     VARCHAR(50),
    phone_number    VARCHAR(12) NOT NULL,
    address         VARCHAR(200),
    email           VARCHAR(100));

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
    
CREATE TABLE PersonnelRecordTable (
    record_number   INTEGER PRIMARY KEY,
    record_date     DATE,
    event_record    VARCHAR(1000),
    employee_number INTEGER NOT NULL,
    FOREIGN KEY (employee_number)
		REFERENCES PersonnelTable(employee_number)
        ON UPDATE CASCADE);

CREATE TABLE TrainingRecordTable (
    record_number   INTEGER PRIMARY KEY,
    record_date     DATE,
    record_content  VARCHAR(1000),
    employee_number INTEGER NOT NULL,
    FOREIGN KEY (employee_number)
		REFERENCES PersonnelTable(employee_number)
        ON UPDATE CASCADE);

CREATE TABLE ResumeTable (
    resume_number   INTEGER PRIMARY KEY,
    resume_date     DATE,
    resume_content  BLOB,
    employee_number INTEGER NOT NULL,
    FOREIGN KEY (employee_number)
		REFERENCES PersonnelTable(employee_number)
        ON UPDATE CASCADE);

CREATE TABLE UserGroupTable (
    group_number    INTEGER NOT NULL,
    employee_number INTEGER NOT NULL,
    FOREIGN KEY (employee_number)
		REFERENCES PersonnelTable(employee_number)
        ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (group_number)
		REFERENCES GroupTable(group_number)
        ON UPDATE CASCADE ON DELETE CASCADE);