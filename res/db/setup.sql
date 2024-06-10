/* 
    --- Setup Database for LCMS ---
        Author(s): L. Kirstein
        Version: 0.1
        Date Modified: 09.06.2024 
    -------------------------------
*/



/* Setup Database */
DROP DATABASE IF EXISTS lcms;
CREATE DATABASE lcms;
USE lcms;



/* Create Table for Users */
CREATE TABLE User(
    User_ID int NOT NULL AUTO_INCREMENT,       /* User ID       */
    User_Name varchar(20),                    /* Username      */
    User_Password varchar(120),              /* Password      */
    User_AccessLevel int,                   /* Access Level  */
    User_EMail varchar(60),                /* E-Mail        */
    User_CDate date,                      /* Creation Date */
    PRIMARY KEY (User_ID)
);



/* Create Table for Posts */
CREATE TABLE Post(
    Post_ID int NOT NULL AUTO_INCREMENT,        /* Post ID                  */
    Post_Title varchar(20),                    /* Post Title               */
    Post_Descriptions varchar(50),            /* Post Description         */
    Post_Content varchar(200),               /* Post Content - TODO      */
    Post_Date date,                         /* Post Creation Date       */
    Post_User int,                         /* Post Creator (User (ID)) */
    PRIMARY KEY (Post_ID),
    FOREIGN KEY (Post_User) REFERENCES User(User_ID)
);



/*
    --- Create Admin-User --- 
        ID:       1
        Username: Administrator
        Password: ChangeMe123!
        AccessLevel: 2
        E-Mail: None (NULL)
        Creation Date: 01-01-2024
    -------------------------
*/
INSERT INTO User VALUES (1, "Administrator", "$2y$10$4qeM8OCi572M/zZrwpwF7ehywOoZ1BIQSapGDB9M/2WW32rtYDDO2", 2, NULL, 20240101);