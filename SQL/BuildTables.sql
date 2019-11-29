DROP TABLE IF EXISTS UserGroupTable;
DROP TABLE IF EXISTS ResumeTable;
DROP TABLE IF EXISTS TrainingRecordTable;
DROP TABLE IF EXISTS PersonnelRecordTable;
DROP TABLE IF EXISTS PersonnelTable;
DROP TABLE IF EXISTS ContactTable;
DROP TABLE IF EXISTS GroupTable;
DROP TABLE IF EXISTS JobTable;
DROP TABLE IF EXISTS AccessLogTable;
DROP TABLE IF EXISTS UserLoginTable;


CREATE TABLE UserLoginTable (
    user_number     INTEGER PRIMARY KEY AUTO_INCREMENT,
    user_name       VARCHAR(25) NOT NULL,
    access_level    INTEGER NOT NULL,
    password_hash   VARCHAR(128) NOT NULL,
    last_login      TIMESTAMP DEFAULT 
		CURRENT_TIMESTAMP 
		ON UPDATE CURRENT_TIMESTAMP);

CREATE TABLE AccessLogTable (
    time_stamp      TIMESTAMP PRIMARY KEY 
		DEFAULT CURRENT_TIMESTAMP,
    user_number     INTEGER NOT NULL,
    login_success   BOOLEAN NOT NULL,
    FOREIGN KEY (user_number)
		REFERENCES UserLoginTable(user_number)
        ON UPDATE CASCADE ON DELETE CASCADE);
    
CREATE TABLE JobTable (
    job_number              INTEGER PRIMARY KEY AUTO_INCREMENT,
    position_name           VARCHAR(100) NOT NULL,
    position_description    VARCHAR(1000));
    
CREATE TABLE GroupTable (
    group_number    INTEGER PRIMARY KEY AUTO_INCREMENT,
    group_name      VARCHAR(100) NOT NULL);

CREATE TABLE ContactTable (
    contact_number  INTEGER PRIMARY KEY AUTO_INCREMENT,
    last_name       VARCHAR(50) NOT NULL,
    first_name      VARCHAR(50) NOT NULL,
    middle_name     VARCHAR(50),
    phone_number    VARCHAR(12) NOT NULL,
    address         VARCHAR(200),
    email           VARCHAR(100));

CREATE TABLE PersonnelTable (
    employee_number             INTEGER PRIMARY KEY AUTO_INCREMENT,
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
    record_number   INTEGER PRIMARY KEY AUTO_INCREMENT,
    record_date     DATE,
    event_record    VARCHAR(1000),
    employee_number INTEGER NOT NULL,
    FOREIGN KEY (employee_number)
		REFERENCES PersonnelTable(employee_number)
        ON UPDATE CASCADE);

CREATE TABLE TrainingRecordTable (
    record_number   INTEGER PRIMARY KEY AUTO_INCREMENT,
    record_date     DATE,
    record_content  VARCHAR(1000),
    employee_number INTEGER NOT NULL,
    FOREIGN KEY (employee_number)
		REFERENCES PersonnelTable(employee_number)
        ON UPDATE CASCADE);

CREATE TABLE ResumeTable (
    resume_number   INTEGER PRIMARY KEY AUTO_INCREMENT,
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
	
INSERT INTO UserLoginTable (user_number, user_name, access_level, password_hash, last_login) VALUES (0, "sysadmin", 3, "$2y$10$adPqrmjo64L6E9jF6WfY8OauqXjt62gn31lDkK4UlAzbYPoUac9Xy", NULL);