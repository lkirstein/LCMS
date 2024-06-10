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
    User_ID INT NOT NULL AUTO_INCREMENT,       /* User ID       */
    User_Name varchar(20),                    /* Username      */
    User_Password varchar(100),              /* Password      */
    User_CDate date,                        /* Creation Date */
    PRIMARY KEY (User_ID)
);



/* Create Table for Posts */
CREATE TABLE Post(
    Post_ID INT NOT NULL AUTO_INCREMENT,        /* Post ID                  */
    Post_Title varchar(20),                    /* Post Title               */
    Post_Descriptions varchar(50),            /* Post Description         */
    Post_Content varchar(200),               /* Post Content - TODO      */
    Post_Date date,                         /* Post Creation Date       */
    Post_User int,                         /* Post Creator (User (ID)) */
    PRIMARY KEY (Post_ID),
    FOREIGN KEY (Post_User) REFERENCES User(User_ID)
);



/* --- Create Admin-User ---  */ 
INSERT INTO User VALUES (1, "Administrator", "ChangeMe123!", 2024-01-01)

