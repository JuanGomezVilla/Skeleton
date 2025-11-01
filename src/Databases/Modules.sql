

-- Contact entries
CREATE TABLE contactEntries (
    id INT(11) AUTO_INCREMENT PRIMARY KEY, -- Primary record identifier
    name VARCHAR(300) NOT NULL, -- Name of individual
    username VARCHAR(300), -- Possible logged in user
    email VARCHAR(300), -- Email address
    phone VARCHAR(100), -- Phone number
    ipClient VARCHAR(100), -- IP address of the user writing the message
    message VARCHAR(1500) NOT NULL -- Message content
) ENGINE=InnoDB;



-- New User Requests
CREATE TABLE newUserRequests (
    username VARCHAR(300) PRIMARY KEY, -- User identifier
    activationCode INT(11) NOT NULL, -- User activation code
    ipClient VARCHAR(100), -- IP address of the user that makes the request
    createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL, -- Creation date
    updateAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL, -- Modification date
    expiryAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL -- Expiry date
) ENGINE=InnoDB;