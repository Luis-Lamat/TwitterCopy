DROP SCHEMA TwitterCopy;
CREATE SCHEMA TwitterCopy;
USE TwitterCopy;

CREATE TABLE User (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password_hash VARCHAR(100) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE Post (
    id INT NOT NULL AUTO_INCREMENT,
    content VARCHAR(140) NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES User(id)
);

CREATE TABLE Friend (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    friend_id INT NOT NULL,
    friends_since TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES User(id),
    FOREIGN KEY(friend_id) REFERENCES User(id)
);

CREATE TABLE Favorites (
    id INT NOT NULL AUTO_INCREMENT,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(post_id) REFERENCES Post(id),
    FOREIGN KEY(user_id) REFERENCES User(id)
);

INSERT INTO user (username, email, password_hash) values ('Luis', 'email@mlg.com', '$2a$10$FWWyJZfZHnr6T2vh6fMhzurX8Pt076GJtmxXS7ALCimaFtyiMxkOi');
