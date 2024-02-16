-- Create the database if it doesn't exist in mariadb
CREATE DATABASE IF NOT EXISTS wizdemy;

-- Use the database
USE wizdemy;

-- Create the users table in mariadb

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    private BOOLEAN DEFAULT FALSE,
    bio VARCHAR(50) DEFAULT 'Hey there! I am using Wizdemy',
    user_type VARCHAR(50) DEFAULT empty,
    education_level VARCHAR(100) empty,
    enrolled_course VARCHAR(100) empty,
    school_name VARCHAR(100) empty,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Create the study_material_requests table
CREATE TABLE study_material_requests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    education_level VARCHAR(255) NOT NULL,
    semester VARCHAR(255),
    subject VARCHAR(255) NOT NULL,
    class_faculty VARCHAR(255) NOT NULL,
    document_type VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);


-- Create the study_materials table
CREATE TABLE study_materials (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    respond_to INT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    document_type VARCHAR(255) NOT NULL,
    format VARCHAR(255) NOT NULL,
    education_level VARCHAR(255) NOT NULL,
    semester VARCHAR(255),
    subject VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    thumbnail_path VARCHAR(255) NOT NULL,
    class_faculty VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (respond_to) REFERENCES study_material_requests(id)
);



-- Create the likes table
CREATE TABLE likes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    study_material_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (study_material_id) REFERENCES study_materials(id)
);

-- Create the comments table
CREATE TABLE comments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    study_material_id INT NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (study_material_id) REFERENCES study_materials(id)
);

-- Create the bookmarks table
CREATE TABLE bookmarks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    study_material_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (study_material_id) REFERENCES study_materials(id)
);

-- Create the reports table
CREATE TABLE reports (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    study_material_id INT NOT NULL,
    report_reason TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (study_material_id) REFERENCES study_materials(id)
);

-- Create the login_history table
CREATE TABLE login_history (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Create the views table
CREATE TABLE views (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    study_material_id INT NOT NULL,
    ip_address VARCHAR(255) NOT NULL,
    device VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (study_material_id) REFERENCES study_materials(id)
);

-- Create the user_follows table
CREATE TABLE user_follows (
    id INT PRIMARY KEY AUTO_INCREMENT,
    follower_id INT NOT NULL,
    following_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (follower_id) REFERENCES users(id),
    FOREIGN KEY (following_id) REFERENCES users(id)
);

-- Create the notifications table
CREATE TABLE notifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    action VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    link VARCHAR(255) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Create the search_history table
CREATE TABLE search_history (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    search_query VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Create the admins table
CREATE TABLE admins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- create a trigger to send notifications to users who follow a user and to the user when a new study material is uploaded in mariadb
DELIMITER $$
CREATE TRIGGER new_study_material_notification
AFTER INSERT ON study_materials
FOR EACH ROW
BEGIN
    INSERT INTO notifications (user_id, title, action, message, link)
    SELECT user_follows.follower_id, 'New Study Material', 'new_study_material', CONCAT('New study material uploaded by ', (SELECT username FROM users WHERE id = NEW.user_id)), CONCAT('/study-materials/', NEW.id)
    FROM user_follows
    WHERE user_follows.following_id = NEW.user_id;

    INSERT INTO notifications (user_id, title, action, message, link)
    VALUES (NEW.user_id, 'New Study Material', 'new_study_material', 'Your study material has been uploaded successfully', CONCAT('/study-materials/', NEW.id));
END;
$$
DELIMITER ;

-- create a trigger to send notifications to users who follow a user and to the user when a new comment is added in mariadb
DELIMITER $$
CREATE TRIGGER new_comment_notification
AFTER INSERT ON comments
FOR EACH ROW
BEGIN
    INSERT INTO notifications (user_id, title, action, message, link)
    SELECT user_follows.follower_id, 'New Comment', 'new_comment', CONCAT('New comment added by ', (SELECT username FROM users WHERE id = NEW.user_id)), CONCAT('/study-materials/', NEW.study_material_id)
    FROM user_follows
    WHERE user_follows.following_id = NEW.user_id;

    INSERT INTO notifications (user_id, title, action, message, link)
    VALUES ((SELECT user_id FROM study_materials WHERE id = NEW.study_material_id), 'New Comment', 'new_comment', CONCAT('New comment added to your study material by ', (SELECT username FROM users WHERE id = NEW.user_id)), CONCAT('/study-materials/', NEW.study_material_id));
END;
$$
DELIMITER ;

-- create a trigger to send notifications to users who follow a user and to the user when a new like is added in mariadb
DELIMITER $$
CREATE TRIGGER new_like_notification
AFTER INSERT ON likes
FOR EACH ROW
BEGIN
    INSERT INTO notifications (user_id, title, action, message, link)
    SELECT user_follows.follower_id, 'New Like', 'new_like', CONCAT('New like added by ', (SELECT username FROM users WHERE id = NEW.user_id)), CONCAT('/study-materials/', NEW.study_material_id)
    FROM user_follows
    WHERE user_follows.following_id = NEW.user_id;

    INSERT INTO notifications (user_id, title, action, message, link)
    VALUES ((SELECT user_id FROM study_materials WHERE id = NEW.study_material_id), 'New Like', 'new_like', CONCAT('New like added to your study material by ', (SELECT username FROM users WHERE id = NEW.user_id)), CONCAT('/study-materials/', NEW.study_material_id));
END;
$$
DELIMITER ;

-- create a trigger to send notifications to users who follow a user and to the user when a new bookmark is added in mariadb
DELIMITER $$
CREATE TRIGGER new_bookmark_notification
AFTER INSERT ON bookmarks
FOR EACH ROW
BEGIN
    INSERT INTO notifications (user_id, title, action, message, link)
    SELECT user_follows.follower_id, 'New Bookmark', 'new_bookmark', CONCAT('New bookmark added by ', (SELECT username FROM users WHERE id = NEW.user_id)), CONCAT('/study-materials/', NEW.study_material_id)
    FROM user_follows
    WHERE user_follows.following_id = NEW.user_id;

    INSERT INTO notifications (user_id, title, action, message, link)
    VALUES ((SELECT user_id FROM study_materials WHERE id = NEW.study_material_id), 'New Bookmark', 'new_bookmark', CONCAT('New bookmark added to your study material by ', (SELECT username FROM users WHERE id = NEW.user_id)), CONCAT('/study-materials/', NEW.study_material_id));
END;
$$
DELIMITER ;

-- create a trigger to send notifications to users who follow a user and to the user when a new report is added in mariadb
DELIMITER $$
CREATE TRIGGER new_report_notification
AFTER INSERT ON reports
FOR EACH ROW
BEGIN
    INSERT INTO notifications (user_id, title, action, message, link)
    SELECT user_follows.follower_id, 'New Report', 'new_report', CONCAT('New report added by ', (SELECT username FROM users WHERE id = NEW.user_id)), CONCAT('/study-materials/', NEW.study_material_id)
    FROM user_follows
    WHERE user_follows.following_id = NEW.user_id;

    INSERT INTO notifications (user_id, title, action, message, link)
    VALUES ((SELECT user_id FROM study_materials WHERE id = NEW.study_material_id), 'New Report', 'new_report', CONCAT('New report added to your study material by ', (SELECT username FROM users WHERE id = NEW.user_id)), CONCAT('/study-materials/', NEW.study_material_id));
END;
$$
DELIMITER ;

-- create a trigger to send notifications to users who follow a user and to the user when a new follow is added in mariadb
DELIMITER $$
CREATE TRIGGER new_follow_notification
AFTER INSERT ON user_follows
FOR EACH ROW
BEGIN
    INSERT INTO notifications (user_id, title, action, message, link)
    VALUES (NEW.follower_id, 'New Follow', 'new_follow', CONCAT('You are now following ', (SELECT username FROM users WHERE id = NEW.following_id)), CONCAT('/users/', NEW.following_id));

    INSERT INTO notifications (user_id, title, action, message, link)
    VALUES (NEW.following_id, 'New Follow', 'new_follow', CONCAT((SELECT username FROM users WHERE id = NEW.follower_id), ' is now following you'), CONCAT('/users/', NEW.follower_id));
END;

DELIMITER ;



