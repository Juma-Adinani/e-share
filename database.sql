CREATE DATABASE examsharingdb;

USE examsharingdb;

CREATE TABLE roles(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    role_type VARCHAR(60) NOT NULL
);

INSERT INTO
    roles (role_type)
VALUES
    ('System administrator'),
    ('School administrator'),
    ('Teacher'),
    ('student'),
    ('Examination board'),
    ('Government agency');

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    middlename VARCHAR(30) NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(100) NULL UNIQUE,
    phone VARCHAR(15) NOT NULL UNIQUE,
    password VARCHAR(200) NOT NULL,
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON UPDATE CASCADE
);

CREATE TABLE schools (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    index_no VARCHAR(30) NOT NULL UNIQUE,
    school_name VARCHAR(60) NOT NULL UNIQUE
);

CREATE TABLE school_admins(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    school_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE,
    FOREIGN KEY (school_id) REFERENCES schools (id) ON UPDATE CASCADE
);

CREATE TABLE classes (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(30) NOT NULL
);

INSERT INTO
    classes (class)
VALUES
    ('FORM I'),
    ('FORM II'),
    ('FORM III'),
    ('FORM IV'),
    ('FORM V'),
    ('FORM VI');


CREATE TABLE subjects(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(30) NOT NULL
);

CREATE TABLE subject_topics(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    topic VARCHAR(80) NOT NULL,
    subject_id INT NOT NULL,
    FOREIGN KEY (subject_id) REFERENCES subjects (id) ON UPDATE CASCADE
);

CREATE TABLE subject_subtopics(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    subtopic VARCHAR(40) NOT NULL,
    topic_id INT NOT NULL,
    FOREIGN KEY (topic_id) REFERENCES subject_topics (id) ON UPDATE CASCADE    
);

CREATE TABLE quizes(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    quiz_name VARCHAR(40) NOT NULL,
    quiz_doc  TEXT NOT NULL,
    subtopic_id INT NOT NULL,
    FOREIGN KEY (subtopic_id) REFERENCES subject_subtopics (id) ON UPDATE CASCADE
);

/* A teacher can teach more than one class */
CREATE TABLE teachers (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    school_id INT NOT NULL,
    class_id INT NOT NULL,
    subject_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE,
    FOREIGN KEY (school_id) REFERENCES schools (id) ON UPDATE CASCADE,
    FOREIGN KEY (class_id) REFERENCES classes (id) ON UPDATE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects (id) ON UPDATE CASCADE
);

/* a student can take only one class */
CREATE TABLE students (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    school_id INT NOT NULL,
    class_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE CASCADE,
    FOREIGN KEY (school_id) REFERENCES schools (id) ON UPDATE CASCADE,
    FOREIGN KEY (class_id) REFERENCES classes (id) ON UPDATE CASCADE
);

CREATE TABLE exam_materials (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    material_type VARCHAR (50) NOT NULL
);

INSERT INTO
    exam_materials (material_type)
VALUES
    ('Exam'),
    ('Notes'),
    ('Quiz'),
    ('Learn & Practices');

CREATE TABLE examination_categories (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    exam_type VARCHAR(60) NOT NULL
);

INSERT INTO
    examination_categories (exam_type)
VALUES
    ('other'),
    ('NECTA EXAM'),
    ('ANNUAL EXAM'),
    ('TERMINAL EXAM'),
    ('MID-TERM EXAM');

CREATE TABLE exam_material_documents (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    thumbnail TEXT NOT NULL,
    document TEXT NOT NULL,
    material_id INT NOT NULL,
    exam_id INT NOT NULL DEFAULT 1,
    subject_id INT NOT NULL,
    year DATE NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE,
    FOREIGN KEY (material_id) REFERENCES exam_materials (id) ON UPDATE CASCADE,
    FOREIGN KEY (exam_id) REFERENCES examination_categories (id) ON UPDATE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects (id) ON UPDATE CASCADE,

);