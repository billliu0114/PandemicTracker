Drop Table IF EXISTS Link_Doctor_Account;
Drop Table IF EXISTS Link_Personal_Account;
Drop Table IF EXISTS Fever_Logic;
Drop Table IF EXISTS Input_Health_Status;
Drop Table IF EXISTS Risk_Level;
Drop Table IF EXISTS Input_Risk_Status;
Drop Table IF EXISTS Resident_Quarantine_Status;
Drop Table IF EXISTS Works_At;
Drop Table IF EXISTS Cases;
Drop Table IF EXISTS Medication;
Drop Table IF EXISTS Records;
Drop Table IF EXISTS Doctor;
Drop Table IF EXISTS Resident;
Drop Table IF EXISTS Medical_Center;
Drop Table IF EXISTS Main_Address;

Create Table Doctor (
    Did			INTEGER,
    Name 			Varchar(60),
    Specialization		Varchar(60),
    PRIMARY KEY (Did)
);

Create Table Main_Address (
	PostalCode	Varchar(7),
	Street		Varchar(60),
	City		Varchar(60) NOT NULL,
	PRIMARY KEY (PostalCode, Street));

Create Table Resident (
	Rid		Integer,
	Email		Varchar(60),
	HealthCare_num	Integer UNIQUE,
	FirstName	Varchar(60),
	LastName	Varchar(60),
	Phone_num	Varchar(12),
	DOB		Date,
	PostalCode	Varchar(7),
	Street		Varchar(60),
	PRIMARY KEY (Rid),
	FOREIGN KEY (PostalCode, Street) REFERENCES Main_Address (PostalCode, Street)
		    ON DELETE SET NULL
		    ON UPDATE CASCADE);

Create Table Link_Doctor_Account (
	UserName	Varchar(60),
	Password	Varchar(60),
	Did		INTEGER NOT NULL,
	PRIMARY KEY (UserName),
	FOREIGN KEY (Did) REFERENCES Doctor (Did) ON DELETE CASCADE ON UPDATE CASCADE);

Create Table Link_Personal_Account (
	UserName	Varchar(60),
	Password	Varchar(60),
	Rid		Integer NOT NULL,
	PRIMARY KEY (UserName),
	FOREIGN KEY (Rid) REFERENCES Resident (Rid)
			ON DELETE CASCADE
			ON UPDATE  CASCADE);

Create Table Fever_Logic (
	Temperature	Real NOT NULL,
	Fever_Status	Varchar(20),
	PRIMARY KEY (Temperature)
);


Create Table Input_Health_Status (
	Date	Date,
	Rid	Integer NOT NULL,
	Temperature	Real,
	FluSymptoms		Boolean,
	PRIMARY KEY (Date, Rid),
	FOREIGN KEY (Rid) REFERENCES Resident (Rid)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
	FOREIGN KEY (Temperature) REFERENCES Fever_Logic (Temperature)
		    ON DELETE CASCADE
		    ON UPDATE CASCADE
);

Create Table Risk_Level (
	ExposureToConfirmedCase	Boolean,
    ConfirmedCaseInNeighbourhood	Boolean, 
    CloseContactHasFlu_likeSymptom	Boolean,
    RiskLevel	Varchar(10),
    PRIMARY KEY (ExposureToConfirmedCase, ConfirmedCaseInNeighbourhood, CloseContactHasFlu_likeSymptom)	
);

Create Table Input_Risk_Status(
	Date	Date,
	Rid	Integer NOT NULL,
	ExposureToConfirmedCase	Boolean,
    ConfirmedCaseInNeighbourhood	Boolean, 
    CloseContactHasFlu_likeSymptom	Boolean,
    PRIMARY KEY (Date, Rid),
    FOREIGN KEY (ExposureToConfirmedCase, ConfirmedCaseInNeighbourhood, CloseContactHasFlu_likeSymptom) REFERENCES Risk_Level (ExposureToConfirmedCase, ConfirmedCaseInNeighbourhood, CloseContactHasFlu_likeSymptom) 
            ON DELETE CASCADE
			ON UPDATE CASCADE
);

Create Table Resident_Quarantine_Status (
	StartDate	Date,
	EndDate	Date,
	Status		Boolean,
	Rid		Integer NOT NULL,
	PRIMARY KEY (StartDate, EndDate, Rid),
	FOREIGN KEY (Rid) REFERENCES Resident (Rid)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);

Create Table Medical_Center (
    Name 			Varchar(60),
    City 			Varchar(60),
    StreetAddress 	Varchar(60),
    PRIMARY KEY (Name, City)
);

Create Table Works_At (
    Did 		INTEGER,
    Name 		Varchar(60),
    City 		Varchar(60),
    PRIMARY KEY (Did, Name, City),
    FOREIGN KEY (Did) 	REFERENCES Doctor (Did)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
    FOREIGN KEY (Name, City) REFERENCES Medical_Center(Name, City)
		    ON DELETE CASCADE
            ON UPDATE CASCADE
);

Create Table Cases (
    CaseNum 		INTEGER AUTO_INCREMENT,
    EncounterDate 	DATE ,
    RecoveryStatus 	Varchar(60),
	Notes           Varchar(5000), 
    Did 			INTEGER NOT NULL,
    RID 			INTEGER NOT NULL,
    PRIMARY KEY (CaseNum),
    FOREIGN KEY (Did) REFERENCES Doctor (Did)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
    FOREIGN KEY (Rid) REFERENCES Resident (Rid)
	    	ON DELETE CASCADE
            ON UPDATE CASCADE
);

Create Table Medication(
    Name 		Varchar(60),
    Dosage 	Varchar(60),
    PRIMARY KEY (Name, Dosage)
);

Create Table Records(
    CaseNum 		INTEGER,
    Name 			Varchar(60),
    Dosage 		Varchar(60),
    PRIMARY KEY (CaseNum),
    FOREIGN KEY (CaseNum) REFERENCES Cases (CaseNum)
            ON DELETE CASCADE
            ON UPDATE CASCADE,
    FOREIGN KEY (Name, Dosage) REFERENCES Medication (Name, Dosage)
		    ON DELETE CASCADE
            ON UPDATE CASCADE
);