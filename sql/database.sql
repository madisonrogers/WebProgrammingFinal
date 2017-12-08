DROP TABLE IF EXISTS person CASCADE;
CREATE TABLE person {
	person_id INT AUTO_INCREMENT,
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	username VARCHAR(255),
	password VARCHAR(255),
	PRIMARY KEY (person_id)
};

DROP TABLE IF EXISTS article CASCADE;
CREATE TABLE article {
	article_id INT AUTO_INCREMENT,
	fk_person_id VARCHAR(255),
	title VARCHAR(255),
	article_text TEXT,
	time_created VARCHAR(255),
	PRIMARY KEY (article_id),
	FOREIGN KEY (fk_person_id) REFERENCES person(person_id)
};