--INSERT INTO UserLoginTable (user_number, user_name, access_level, password_hash, last_login)
	--VALUES (1234, 'sysad', 0, 'ajkaskklnsd', DATE '2019-11-19');
    
--INSERT INTO AccessLogTable (time_stamp, user_number, login_success)
--	VALUES ('2019-11-19 17:00:00', 1234, TRUE);

INSERT INTO JobTable (position_name, position_description)
	VALUES ('Project Manager', 'Responsible for the oversight and execution of all assigned projects.');
	-- Populate GroupTable
INSERT INTO GroupTable (group_name)
	VALUES ('Software Development');
	INSERT INTO GroupTable (group_name)
	VALUES ('Project Management');
	INSERT INTO GroupTable (group_name)
	VALUES ('Accounting');
	INSERT INTO GroupTable (group_name)
	VALUES ('Marketing');
	INSERT INTO GroupTable (group_name)
	VALUES ('Quality Assurance');
    
INSERT INTO ContactTable (last_name, first_name, middle_name, phone_number, address, email)
	VALUES ('Smith', 'Bob', 'Robert', '555-555-5555', '1234 Nowhere St, Springfield, IL 12345', 'bobsmith@UCS.com');

INSERT INTO ContactTable (last_name, first_name, middle_name, phone_number, address, email)
	VALUES ('Smith', 'Janice', 'Joy', '555-555-5551', '1234 Nowhere St, Springfield, IL 12345', 'jsmith@gmail.com');
    
INSERT INTO PersonnelTable (user_number, SSN, personal_contact_number, emergency_contact_number, job_number)
	VALUES (3, '123-45-6789', 8921, 8922, 3232);


INSERT INTO PersonnelRecordTable (record_date, event_record, employee_number)
	VALUES (DATE '2019-11-19', 'Initial contact for this employee was a success.', 2932);

INSERT INTO TrainingRecordTable (record_date, record_content, employee_number)
	VALUES (DATE '2019-11-19', 'Employee has been trained on system login procedures.', 2932);

INSERT INTO ResumeTable (resume_date, resume_content, employee_number)
	VALUES (DATE '2019-11-19', '1293809292309481093409812', 2932);

INSERT INTO UserGroupTable (group_number, employee_number)
	VALUES (2312, 2932);