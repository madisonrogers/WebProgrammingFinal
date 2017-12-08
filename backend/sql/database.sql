SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS person;
CREATE TABLE person 
(
	person_id INT AUTO_INCREMENT,
	full_name VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	username VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	PRIMARY KEY (person_id)
);

DROP TABLE IF EXISTS article CASCADE;
CREATE TABLE article
(
	article_id INT AUTO_INCREMENT,
	fk_person_id INT NOT NULL,
	title VARCHAR(255) NOT NULL,
	article_text TEXT NOT NULL,
	time_created VARCHAR(255),
	PRIMARY KEY (article_id),
	FOREIGN KEY (fk_person_id) REFERENCES person(person_id) ON DELETE CASCADE
);