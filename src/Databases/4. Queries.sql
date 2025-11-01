-- Write your help queries here

-- Example 1
SELECT username,
    name,
    surname,
    email,
    userType,
    language,
    timesLogged,
    darkMode,
    autoLogout,
    enabled,
    waiting,
    gender,
    createAt,
    updateAt
FROM users;

-- Example 2
SELECT id, name, value FROM settings;