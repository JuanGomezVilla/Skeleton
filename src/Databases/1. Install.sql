-- 1. Database setup
CREATE DATABASE type_here_database_name CHARACTER SET utf8 COLLATE utf8_general_ci;

-- 2. Select datbase
USE type_here_database_name;

-- 3. Settings
CREATE TABLE settings (
    id INT NOT NULL PRIMARY KEY,    -- Primary record identifier 
    name VARCHAR(50) NOT NULL,      -- Setting name
    value VARCHAR(50) NOT NULL,     -- Setting value
    UNIQUE KEY (name)               -- Unique value
) ENGINE=InnoDB;

-- 4. Users
CREATE TABLE users (
    username VARCHAR(300) PRIMARY KEY,                      -- Username, primary value
    name VARCHAR(300) NOT NULL,                             -- Name
    surname VARCHAR(300) NOT NULL,                          -- Surname
    password CHAR(128) NOT NULL,                            -- Password, in SHA2 512
    email VARCHAR(300) NOT NULL,                            -- User email
    userType VARCHAR(200) NOT NULL,                         -- Type of user
    language VARCHAR(50) NOT NULL,                          -- Preferred language
    timesLogged INT NOT NULL,                               -- Times the user has logged in
    darkMode BOOLEAN DEFAULT 0 NOT NULL,                    -- Dark mode
    autoLogout BOOLEAN DEFAULT 1 NOT NULL,                  -- Auto logout
    enabled BOOLEAN DEFAULT 0 NOT NULL,                     -- Enabled state
    waiting BOOLEAN DEFAULT 1 NOT NULL,                     -- Waiting for enabled
    gender ENUM("male", "female", "unknown"),               -- Gender (if null, it is considered unknown)
    createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,  -- Creation date
    updateAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL   -- Modification date
) ENGINE=InnoDB;

-- 5. History
CREATE TABLE history (
    id INT AUTO_INCREMENT PRIMARY KEY,                          -- Primary record identifier
    username VARCHAR(150),                                      -- User who produced the record, can be a unique value
    ipAdress VARCHAR(150),                                      -- IP Address
    recordType ENUM("info", "warning", "critical") NOT NULL,    -- Type of register
    createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,      -- Creation date
    description VARCHAR(999)                                    -- Record description
) ENGINE=InnoDB;

-- 6. Default settings
INSERT INTO settings VALUES
    (1,  "range_start_time",         "0:01"),
    (2,  "range_end_time",           "23:59"),
    (3,  "time_range_enabled",       "1"),
    (4,  "banned_login_fail",        "1"),
    (5,  "banned_login_minutes",     "1"),
    (6,  "max_login_attemps",        "3"),
    (7,  "allow_change_autologout",  "0"),
    (8,  "allow_change_darkmode",    "0"),
    (9,  "allow_change_language",    "0"),
    (10, "allow_signup",             "1"),
    (11, "minutes_to_autologout",    "10");

-- PROCEDURES
DELIMITER $$

-- Increase a users logins by 1
CREATE PROCEDURE incrementTimesLogged(
    paramUsername VARCHAR(150)
)
BEGIN
    UPDATE users SET timesLogged = timesLogged + 1 WHERE username = paramUsername;
END $$


-- FUNCTIONS

-- Function to enable or disable user
CREATE FUNCTION setEnabledStatusUser(
    paramEnabled BOOLEAN, -- Enabled state
    paramUsername VARCHAR(150) -- Username
)
RETURNS INT
BEGIN
    UPDATE users SET enabled = paramEnabled WHERE username = paramUsername;
    RETURN (SELECT enabled FROM users WHERE username = paramUsername);
END $$




-- TRIGGERS

-- Update user
CREATE TRIGGER updateUserOnModify
BEFORE UPDATE ON users
FOR EACH ROW
BEGIN
    IF NEW.username <> OLD.username OR
        NEW.name <> OLD.name OR
        NEW.surname <> OLD.surname OR
        NEW.password <> OLD.password OR
        NEW.language <> OLD.language OR
        NEW.darkMode <> OLD.darkMode OR
        NEW.autoLogout <> OLD.autoLogout OR
        NEW.userType <> OLD.userType OR
        NEW.enabled <> OLD.enabled OR
        NEW.waiting <> OLD.waiting
    THEN
        SET NEW.updateAt = CURRENT_TIMESTAMP();
    END IF;
END $$


DELIMITER ;