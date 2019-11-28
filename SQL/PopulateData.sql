INSERT INTO UserLoginTable (user_number, user_name, access_level, password_hash, last_login) 
	VALUES (1234, 'sysad', 0, 'ajkaskklnsd', DATE '2019-11-19');
    
INSERT INTO AccessLogTable (time_stamp, user_number, login_success) 
	VALUES ('2019-11-19 17:00:00', 1234, TRUE);

INSERT INTO JobTable (job_number, position_name, position_description)
	VALUES (3232, 'Project Manager', 'Responsible for the oversight and execution of all assigned projects.');
    
INSERT INTO GroupTable (group_number, group_name)
	VALUES (2312, 'Software Development');
    
INSERT INTO ContactTable (contact_number, last_name, first_name, middle_name, phone_number, address, email)
	VALUES (8921, 'Smith', 'Bob', 'Robert', '555-555-5555', '1234 Nowhere St, Springfield, ?? 12345', 'bobsmith@UCS.com');

INSERT INTO ContactTable (contact_number, last_name, first_name, middle_name, phone_number, address, email)
	VALUES (8922, 'Smith', 'Janice', 'Joy', '555-555-5551', '1234 Nowhere St, Springfield, ?? 12345', 'jsmith@gmail.com');
    
INSERT INTO PersonnelTable (employee_number, user_number, SSN, personal_contact_number, emergency_contact_number, job_number)
	VALUES (2932, 1234, '123-45-6789', 8921, 8922, 3232);

INSERT INTO PersonnelRecordTable (record_number, record_date, event_record, employee_number)
	VALUES (4322, DATE '2019-11-19', 'Initial contact for this employee was a success.', 2932);

INSERT INTO TrainingRecordTable (record_number, record_date, record_content, employee_number)
	VALUES (8222, DATE '2019-11-19', 'Employee has been trained on system login procedures.', 2932);

INSERT INTO ResumeTable (resume_number, resume_date, resume_content, employee_number)
	VALUES (4932, DATE '2019-11-19', '1293809292309481093409812', 2932);

INSERT INTO UserGroupTable (group_number, employee_number)
	VALUES (2312, 2932);