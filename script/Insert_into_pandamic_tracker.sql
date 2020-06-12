insert into Doctor
values(12345, 'Lucas', 'Respiratory');
insert into Doctor
values(67890, 'Dan', 'Respiratory');
insert into Doctor
values(13579, 'Jeniffer', 'Family Medicine');
insert into Doctor
values(24680, 'Maggie', 'Medical Biochemistry');
insert into Doctor
values(13927, 'Leo', 'Infectious Diseases');

insert into Main_Address
values('V6T1A1', '1101 This Street', 'Vancouver');
insert into Main_Address
values('V6T1A2', '1201 That Street', 'Richmond');
insert into Main_Address
values('V6T1A3', '1301 Another Street', 'Burnaby');
insert into Main_Address
values('V6T1A4', '1401 One Street', 'Hope');
insert into Main_Address
values('V6T1A5', '1501 Two Street', 'Vancouver');

insert into Resident
values(1, '1@j.mail', 1111, 'John', 'Doe', '6041231231', '1990-01-01', 'V6T1A1', '1101 This Street');
insert into Resident
values(2, '2@j.mail', 2222, 'Jack', 'Ma', '7781231231', '1999-02-02', 'V6T1A2', '1201 That Street');
insert into Resident
values(3, '3@j.mail', 3333, 'Samll', 'Cat', '2361231231', '2001-03-03', 'V6T1A3', '1301 Another Street');
insert into Resident
values(4, '4@j.mail', 4444, 'Big', 'Dog', '7181231231', '2011-04-04', 'V6T1A4', '1401 One Street');
insert into Resident
values(5, '5@j.mail', 5555, 'Tiny', 'Mouse', '6131231231', '2015-05-05', 'V6T1A5', '1501 Two Street');
insert into Resident
values(6, '6@j.mail', 6666, 'Little', 'Snake', '6043242421', '1975-08-18', 'V6T1A1', '1101 This Street');

insert into Link_Doctor_Account
values('ilovedoctor', '123456', 12345);
insert into Link_Doctor_Account
values('doctor123', '123123', 67890);
insert into Link_Doctor_Account
values('meowmeow', 'meow123', 13579);
insert into Link_Doctor_Account
values('blablabla', 'bla123', 24680);
insert into Link_Doctor_Account
values('hahaha', 'haha', 13927);

insert into Link_Personal_Account
values('person', '1234567', 1);
insert into Link_Personal_Account
values('resident', '9876543', 2);
insert into Link_Personal_Account
values('hello123', 'password123', 3);
insert into Link_Personal_Account
values('myname', 'qwertyu', 4);
insert into Link_Personal_Account
values('ubcstudent1', 'iloveubc', 5);

insert into Fever_Logic
values(37.5, 'Low Fever');
insert into Fever_Logic
values(35.5, 'Normal');
insert into Fever_Logic
values(38, 'Fever');
insert into Fever_Logic
values(38.5, 'Fever');
insert into Fever_Logic
values(39.5, 'High Fever');

insert into Input_Health_Status
values('2020-01-29', 1, 37.5, 0);
insert into Input_Health_Status
values('2020-02-03', 3, 35.5, 0);
insert into Input_Health_Status
values('2020-03-16', 4, 38, 1);
insert into Input_Health_Status
values('2020-02-27', 2, 38.5, 1);
insert into Input_Health_Status
values('2019-11-23', 5, 39.5, 1);

-- True = 1, False = 0
insert into Risk_Level
values(1, 1, 1, 'High');
insert into Risk_Level
values(1, 1, 0, 'High');
insert into Risk_Level
values(0, 0, 0, 'Low');
insert into Risk_Level
values(1, 0, 0, 'High');
insert into Risk_Level
values(0, 1, 0, 'Medium');

insert into Input_Risk_Status
values('2020-01-29', 1, 0, 0, 0);
insert into Input_Risk_Status
values('2020-02-03', 3, 0, 0, 0);
insert into Input_Risk_Status
values('2020-03-16', 4, 0, 1, 0);
insert into Input_Risk_Status
values('2020-02-27', 2, 1, 0, 0);
insert into Input_Risk_Status
values('2019-11-23', 5, 1, 1, 1);

insert into Resident_Quarantine_Status
values('2020-01-01', '2020-01-15', 0, 1);
insert into Resident_Quarantine_Status
values('2020-05-30', '2020-06-30', 1, 2);
insert into Resident_Quarantine_Status
values('2020-03-02', '2020-03-16', 0, 3);
insert into Resident_Quarantine_Status
values('2020-02-02', '2020-02-28', 0, 4);
insert into Resident_Quarantine_Status
values('2020-03-04', '2020-03-18', 0, 5);

insert into Medical_Center
values('Vancouver General Hospital', 'Vancouver', '899 W 12th Ave');
insert into Medical_Center
values('Surrey Memorial Hospital', 'Surrey', '13750 96 Ave');
insert into Medical_Center
values('Richmond Hospital', 'Richmond', '7000 Westminster Hwy');
insert into Medical_Center
values('BC Women’s Hospital', 'Vancouver', '4500 Oak St');
insert into Medical_Center
values('West 10th Medical Clinic', 'Vancouver', '4303 W 10th Ave');

insert into Works_At
values(12345, 'Vancouver General Hospital', 'Vancouver');
insert into Works_At
values(67890, 'Surrey Memorial Hospital', 'Surrey');
insert into Works_At
values(13579, 'Richmond Hospital', 'Richmond');
insert into Works_At
values(24680, 'BC Women’s Hospital', 'Vancouver');
insert into Works_At
values(13927, 'West 10th Medical Clinic', 'Vancouver');

insert into Cases
values(1, '2020-03-23', 'Positive', 12345, 1);
insert into Cases
values(2, '2020-02-12', 'Positive', 67890, 2);
insert into Cases
values(3, '2020-01-23', 'Recovered', 13579, 3);
insert into Cases
values(4, '2019-12-12', 'Negative', 24680, 4);
insert into Cases
values(5, '2020-01-08', 'Deceased', 12345, 6);

insert into Medication
values('NULL', 'NULL');
insert into Medication
values('Ibuprofen', '800mg');
insert into Medication
values('Amoxicillin', '500mg');
insert into Medication
values('Acetaminophen', '700mg');
insert into Medication
values('Hydroxychloroquine', '800mg');

insert into Records
values(1, 'Ibuprofen', '800mg');
insert into Records
values(2, 'Amoxicillin', '500mg');
insert into Records
values(3,'Acetaminophen', '700mg');
insert into Records
values(4, 'NULL', 'NULL');
insert into Records
values(5, 'Hydroxychloroquine', '800mg');


