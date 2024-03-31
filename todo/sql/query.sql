use todoapp;

CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL UNIQUE,
  email varchar(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE tasks (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  category ENUM('Important', 'Main', 'Urgent', 'Work', 'On Hold'),
  completed BOOLEAN DEFAULT FALSE,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

ALTER TABLE tasks
ADD COLUMN created_at date;
select count(completed) from tasks where completed = true;
SELECT COUNT(category) FROM tasks WHERE category = 'On Hold';

SELECT * FROM users;
SELECT * FROM tasks;

SELECT count(id) FROM tasks;
select category from tasks;

SET SQL_SAFE_UPDATES=0;
delete from users