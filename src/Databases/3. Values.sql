-- Escribe aquí la inserción de valores de tus tablas

INSERT INTO users VALUES
    ("username1", "Name1", "Surname1", SHA2("password", 512), "email", "userType", "es", 0, 0, 0, 1, 0, "male", NOW(), NOW()),
    ("username2", "Name2", "Surname2", SHA2("password", 512), "email", "userType", "es", 0, 0, 0, 1, 0, "female", NOW(), NOW()),
    ("username3", "Name3", "Surname3", SHA2("password", 512), "email", "userType", "es", 0, 0, 0, 1, 0, "unknown", NOW(), NOW());