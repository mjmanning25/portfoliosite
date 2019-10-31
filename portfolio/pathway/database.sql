DROP TABLE if exists Programme;
CREATE TABLE Programme (
    ProgrammeID int NOT NULL auto_increment,
    ProgrammeName varchar(255),
    PRIMARY KEY (ProgrammeID)
)ENGINE = MyISAM;

DROP TABLE if exists Pathway;
CREATE TABLE Pathway (
    PathwayID int NOT NULL auto_increment,
    PathwayName varchar(255),
	ProgrammeID int,
    PRIMARY KEY (PathwayID)
)ENGINE = MyISAM;

DROP TABLE if exists Course;
CREATE TABLE Course (
    CourseID int not null auto_increment,
    CourseCode varchar(8) NOT NULL,
	Level int,
    CourseName varchar(255),
	PathwayID int,
	PreRequisite varchar(510),
	CoRequisite varchar(255),
	Compulsory char(1),
	Credits int,
    PRIMARY KEY (CourseID)
)ENGINE = MyISAM;

--Insert Unitec Programmes
INSERT INTO Programme VALUES (1, 'Bachelor of Computing Systems');
INSERT INTO Programme VALUES (2, 'Graduate Diploma in Computing');

--Insert Unitec Programme Pathways
INSERT INTO Pathway VALUES (1, 'Computing networks and cloud computing', 1);
INSERT INTO Pathway VALUES (2, 'Software engineering', 1);
INSERT INTO Pathway VALUES (3, 'Games development', 1);
INSERT INTO Pathway VALUES (4, 'Business intelligence', 1);
INSERT INTO Pathway VALUES (5, 'Cybersecurity', 1);

--Level 5 Courses COMPULSORY
INSERT INTO Course VALUES (1, 'ISCG5400', 5, 'Hardware Fundamentals', NULL, NULL, NULL, 'Y', 15);
INSERT INTO Course VALUES (2, 'ISCG5401', 5, 'Operating System Fundamentals', NULL, NULL, NULL, 'Y', 15);
INSERT INTO Course VALUES (3, 'ISCG5420', 5, 'Programming Fundamentals', NULL, NULL, NULL, 'Y', 15);
INSERT INTO Course VALUES (4, 'ISCG5423', 5, 'Introduction to Databases', NULL, NULL, NULL, 'Y', 15);
INSERT INTO Course VALUES (5, 'ISCG5424', 5, 'Information Systems Concepts', NULL, NULL, NULL, 'Y', 15);
INSERT INTO Course VALUES (6, 'ISCG5430', 5, 'Professional Skills for IT Practitioners', NULL, NULL, NULL, 'Y', 15);

--Level 5 ELECTIVES
INSERT INTO Course VALUES (7, 'HTCS5700', 5, 'Cyber Security Principles', 5, NULL, NULL, 'N', 15);
INSERT INTO Course VALUES (8, 'ISCG5403', 5, 'Networking Fundamentals', 1, NULL, NULL, 'N', 15);
INSERT INTO Course VALUES (9, 'ISCG5421', 5, 'Programming Principles and Practice', NULL, NULL, NULL, 'N', 15);
INSERT INTO Course VALUES (10, 'ISCG5422', 5, 'Multimedia and Website Development', 2, NULL, NULL, 'N', 15);

--Level 6 Courses COMPULSORY
INSERT INTO Course VALUES (11, 'ISCG6411', 6, 'Project Planning and Control', NULL, 'ISCG5410 or ISCG5424', 'ISCG5430', 'Y', 15);

--Level 6 ELECTIVES
--ELECTIVE Computing networks and cloud computing
INSERT INTO Course VALUES (12, 'ISCG6400', 6, 'Hardware Technology', 1, 'ISCG5400', 'ISCG5430', 'N', 15);
INSERT INTO Course VALUES (13, 'ISCG6401', 6, 'Data Communications and Networks', 1, 'ISCG5403', 'ISCG5430', 'N', 15);
INSERT INTO Course VALUES (14, 'ISCG6402', 6, 'Network Administration and Support', 1, 'ISCG5400 and ISCG5403', 'ISCG5430', 'N', 15);
INSERT INTO Course VALUES (15, 'ISCG6403', 6, 'Network Operating Systems Management', 1, 'ISCG5401', 'ISCG5430', 'N', 15);
INSERT INTO Course VALUES (16, 'ISCG6404', 6, 'Web Server Management',  1, '(ISCG6402 or ISCG6225) and (ISCG5422 or ISCG5242)', 'ISCG5430', 'N', 15);

--ELECTIVE Cybersecurity
INSERT INTO Course VALUES (17, 'ISCG6407', 6, 'Fundamental Concepts in Cyber Security', 5, 'ISCG5403', NULL, 'N', 15);
INSERT INTO Course VALUES (18, 'ISCG6410', 6, 'Information Gathering', NULL, 'ISCG5410', NULL, 'N', 15);
INSERT INTO Course VALUES (19, 'ISCG6412', 6, 'Help Desk', NULL, 'ISCG5410', 'ISCG5430', 'N', 15);

--ELECTIVE Software engineering
INSERT INTO Course VALUES (20, 'ISCG6413', 6, 'Testing and Quality Assurance in ICT', 2, NULL, 'ISCG5430', 'N', 15);
INSERT INTO Course VALUES (21, 'ISCG6414', 6, 'Systems Analysis and Design', 2, '(ISCG5410 or ISCG5424) and (ISCG5421 or ISCG5236)', 'ISCG5237 or
ISCG5430', 'N', 15); --course can be in Business Intelligence and Software Engineering
INSERT INTO Course VALUES (22, 'ISCG6420', 6, 'Internet and Website Development', 2, '(ISCG5422 or ISCG5242) and ISCG5420', 'ISCG5430', 'N', 15);
INSERT INTO Course VALUES (23, 'ISCG6421', 6, 'GUI Programming', 2, '(ISCG5421 or ISCG5239) and ISCG5423 ', 'ISCG5430', 'N', 15);
INSERT INTO Course VALUES (24, 'ISCG6422', 6, 'Multimedia Programming', 2, '(ISCG5420 or ISCG5235) & (ISCG5422 or ISCG5242)', 'ISCG5430', 'N', 15);
INSERT INTO Course VALUES (25, 'ISCG6423', 6, 'Database Design and Development', 2, 'ISCG5423 and ISCG5421', 'ISCG5430', 'N', 15);
INSERT INTO Course VALUES (26, 'ISCG6424', 6, 'User Interface Design', 2, 'ISCG5421 or ISCG5239 or ISCG5422 or ISCG5242', 'ISCG5430', 'N', 15);
INSERT INTO Course VALUES (27, 'ISCG6425', 6, 'Data Warehousing', 2, 'ISCG5423', NULL, 'N', 15);
INSERT INTO Course VALUES (28, 'ISCG6426', 6, 'Data Structures and Algorithms', 2, 'ISCG5421', NULL, 'N', 15);

--ELECTIVE Business intelligence
INSERT INTO Course VALUES (29, 'ISCG6432', 6, 'ICT Industry Culture', 4, 'ISCG5430', NULL, 'N', 15);
INSERT INTO Course VALUES (30, 'ISCG6433', 6, 'ICT Customer Service Centre Skills', 4, 'ISCG5430', NULL, 'N', 15);
INSERT INTO Course VALUES (31, 'ISCG6434', 6, 'ICT Technical Project', 4, 'At least 180 credits', NULL, 'N', 30);
INSERT INTO Course VALUES (32, 'ISCG6436', 6, 'ICT Technical Solutions', 4, 'At least 120 credits', NULL, 'N', 15);

INSERT INTO Course VALUES (33, 'ISCG6435', 6, 'Special Topic', NULL, NULL, NULL, 'N', 15);

--ELECTIVE Games development
INSERT INTO Course VALUES (34, 'ISCG6441', 6, 'Visual Game Design', 3, NULL, NULL, 'N', 15);
INSERT INTO Course VALUES (35, 'ISCG6442', 6, 'Game Programming', 3, 'ISCG5421', 'ISCG6426', 'N', 15);

INSERT INTO Course VALUES (36, 'ISCG6488', 6, 'Negotiated Study', NULL, 'Approval by the relevant Academic Authority AND student must have completed 180 credits towards their BCS degree.', NULL, 'N', 15);

--Level 7 Courses COMPULSORY
INSERT INTO Course VALUES(37, 'ISCG7431', 7, 'Capstone Project', NULL, '195 BCS Credits', NULL, 'Y', 60);

--Level 7 ELECTIVES

INSERT INTO Course VALUES (38, 'ISCG7400', 7, 'Computer Systems Security', NULL, 'ISCG6402 or ISCG6225', NULL, 'N', 15);
INSERT INTO Course VALUES (39, 'ISCG7401', 7, 'Advanced Data Communications', NULL, 'ISCG6401 or ISCG6221', NULL, 'N', 15);
INSERT INTO Course VALUES (40, 'ISCG7402', 7, 'Network Design and Implementation', NULL, '(ISCG6402 or ISCG6225) and (ISCG6401 or ISCG6221)', NULL, 'N', 15);
INSERT INTO Course VALUES (41, 'ISCG7404', 7, 'Computer Forensic Investigations', NULL, 'ISCG6401 or ISCG6402', NULL, 'N', 15);
INSERT INTO Course VALUES (42, 'ISCG7406', 7, 'Cyber Security Policy', NULL, 'ISCG6407', NULL, 'N', 15);
INSERT INTO Course VALUES (43, 'ISCG7407', 7, 'Advanced Cyber Security', Null, 'ISCG6407 and ISCG6400 and ISCG6403', NULL, 'N', 15);
INSERT INTO Course VALUES (44, 'ISCG7408', 7, 'Malware Analysis', NULL, 'ISCG6407', NULL, 'N', 15);
INSERT INTO Course VALUES (45, 'ISCG7409', 7, 'Cyber Security for Finance Professionals', NULL, NULL, NULL, 'N', 15);

INSERT INTO Course VALUES (46, 'ISCG7410', 7, 'Information Systems Management', NULL, 'ISCG6411', NULL, 'N', 15);
INSERT INTO Course VALUES (47, 'ISCG7411', 7, 'Project Management Methodologies', NULL, 'ISCG6407', NULL, 'N', 15);
INSERT INTO Course VALUES (48, 'ISCG7408', 7, 'Malware Analysis', NULL, 'ISCG6407', NULL, 'N', 15);
