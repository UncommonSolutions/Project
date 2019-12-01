-- Populate Group Table
INSERT INTO GroupTable(group_name) VALUES('Software Development');
INSERT INTO GroupTable(group_name) VALUES('Accounting');
INSERT INTO GroupTable(group_name) VALUES('Human Resources');
INSERT INTO GroupTable(group_name) VALUES('Quality Assurance');
INSERT INTO GroupTable(group_name) VALUES('Marketing');


-- Populate Job Table
INSERT INTO JobTable (position_name, position_description)
VALUES ('Project Manager', 'Responsible for the oversight and execution of all assigned projects.');
INSERT INTO JobTable (position_name, position_description)
VALUES ('Software Development', 'Develop software');
INSERT INTO JobTable (position_name, position_description)
VALUES ('Integration Engineer', 'Integrate the various software components');
INSERT INTO JobTable (position_name, position_description)
VALUES ('UX/HCI', 'Design user interface for software products');
INSERT INTO JobTable (position_name, position_description)
VALUES ('Technical Writer', 'Compile technical specifications and requirements into readable documentation');
INSERT INTO JobTable (position_name, position_description)
VALUES ('Test Engineer', 'Perform regression testing, integration testing, smoke testing, and interface testing on software products.');


-- Add test users (user_numbers's will be 2, 3, 4)
INSERT INTO UserLoginTable (user_name, access_level, password_hash, last_login)
VALUES ("testbasicuser", 0, "$2y$10$wOxYjUyuHwobJ17jnUsyMuNOITvbzE0kno/jv/2kuwhZnmSWNqJHm", NULL);

INSERT INTO UserLoginTable (user_name, access_level, password_hash, last_login)
VALUES ("testprivilegeduser", 1, "$2y$10$wOxYjUyuHwobJ17jnUsyMuNOITvbzE0kno/jv/2kuwhZnmSWNqJHm", NULL);

INSERT INTO UserLoginTable (user_name, access_level, password_hash, last_login)
VALUES ("testrecordsadmin", 2, "$2y$10$wOxYjUyuHwobJ17jnUsyMuNOITvbzE0kno/jv/2kuwhZnmSWNqJHm", NULL);


-- Add test user info to ContactTable (contact_number(s) will be 1, 2, 3)
INSERT INTO ContactTable (last_name, first_name, middle_name, phone_number, address, email)
	VALUES ('TestBasicUser', 'Bob', 'Robert', '555-555-5555', '1234 Nowhere St, Springfield, IL 12345', 'bobsmith@UCS.com');

INSERT INTO ContactTable (last_name, first_name, middle_name, phone_number, address, email)
	VALUES ('TestPrivilegedUser', 'Janice', 'Joy', '555-555-5551', '1234 Nowhere St, Springfield, IL 12345', 'jjoyh@gmail.com');

INSERT INTO ContactTable (last_name, first_name, middle_name, phone_number, address, email)
VALUES ('TestRecordsAdmin', 'John', 'Doe', '555-555-5551', '1234 Nowhere St, Springfield, IL 12345', 'jdoe@gmail.com');


-- populate PersonnelTable with test data (employee_number(s) will be 1, 2, 3)
INSERT INTO PersonnelTable (user_number, SSN, personal_contact_number, emergency_contact_number, job_number, group_number)
	VALUES (1, '123-45-6789', 1, 1, 1, 1);

INSERT INTO PersonnelTable (user_number, SSN, personal_contact_number, emergency_contact_number, job_number, group_number)
VALUES (2, '253-45-6789', 2, 2, 2, 2);

INSERT INTO PersonnelTable (user_number, SSN, personal_contact_number, emergency_contact_number, job_number, group_number)
VALUES (3, '999-45-6789', 3, 3, 3, 3);


-- populate PersonnelRecordTable with test data (record_number(s) will be 1, 2, 3)
INSERT INTO PersonnelRecordTable (record_date, event_record, employee_number)
	VALUES (DATE '2019-11-19', 'Initial contact for this employee was a success.', 1);

INSERT INTO PersonnelRecordTable (record_date, event_record, employee_number)
VALUES (DATE '2019-11-19', 'Initial contact for this employee was a success.', 2);

INSERT INTO PersonnelRecordTable (record_date, event_record, employee_number)
VALUES (DATE '2019-11-19', 'Initial contact for this employee was a success.', 3);


-- Populate TrainingRecordTable with test data (record_number(s) will be 1, 2, 3)
INSERT INTO TrainingRecordTable (record_date, record_content, employee_number)
	VALUES (DATE '2019-11-19', 'Employee has been trained on system login procedures.', 1);

INSERT INTO TrainingRecordTable (record_date, record_content, employee_number)
VALUES (DATE '2019-11-19', 'Employee has been trained on system login procedures.', 2);

INSERT INTO TrainingRecordTable (record_date, record_content, employee_number)
VALUES (DATE '2019-11-19', 'Employee has been trained on system login procedures.', 3);


-- Populate ResumeTable with test data(resume_number(s) will be 1, 2 3)
INSERT INTO ResumeTable (resume_date, resume_content, employee_number)
	VALUES (DATE '2019-11-19', '1293809292309481093409812', 1);

INSERT INTO ResumeTable (resume_date, resume_content, employee_number)
VALUES (DATE '2019-11-19', '1293809292309481093409812', 2);

INSERT INTO ResumeTable (resume_date, resume_content, employee_number)
VALUES (DATE '2019-11-19', '1293809292309481093409812', 3);
