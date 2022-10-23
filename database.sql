PRAGMA foreign_keys = ON;
.mode columns
.headers on
.nullvalue NULL
BEGIN TRANSACTION;

-----------------------------------------
-- Types
-----------------------------------------

CREATE TYPE task_state AS ENUM ('To Do','Doing','Done');
Create TYPE task_priority AS ENUM ('High', 'Medium', 'Low');
CREATE TYPE user_role AS ENUM ('Collaborator', 'Coordinator');
CREATE TYPE notification_type AS ENUM ('Invite', 'Comment', 'Assign', 'TaskState');

-----------------------------------------
-- Tables
-----------------------------------------
-- Table1: authenticated_user
DROP TABLE IF EXISTS authenticated_user;

CREATE TABLE authenticated_user (
    id_user INTEGER PRIMARY KEY,
    email TEXT NOT NULL UNIQUE,
    username TEXT NOT NULL UNIQUE,
    name TEXT NOT NULL,
    password TEXT NOT NULL, 
    phone_number TEXT, 
    deleted BOOL DEFAULT FALSE
);

-- Table2: photo
DROP TABLE IF EXISTS photo;

CREATE TABLE photo (
    id_photo INTEGER PRIMARY KEY,
    path NOT NULL,
    id_user INTEGER REFERENCES authenticated_user(id_user)
);

-- Table3: project
DROP TABLE IF EXISTS project;

CREATE TABLE project (
    id_project INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    details TEXT,
    creation_date DATE NOT NULL,
    archived BOOL NOT NULL,
    id_creator INTEGER REFERENCES authenticated_user(id_user) 
);

-- Table4: task
DROP TABLE IF EXISTS task;

CREATE TABLE task (
    id_project INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    state NOT NULL,
    details TEXT,
    creation_date DATE NOT NULL,
    archived BOOL NOT NULL,
    id_project INTEGER REFERENCES project(id_project),
    id_user INTEGER REFERENCES authenticated_user(id_user)
);

-- Table5: notification
DROP TABLE IF EXISTS notification;

CREATE TABLE notification (
    id_notification INTEGER PRIMARY KEY,
    date DATE NOT NULL,
    details TEXT,
    id_project INTEGER REFERENCES project(id_project),
    id_invite INTEGER REFERENCES invite(id_invite),
    id_comment INTEGER REFERENCES comment(id_comment), 
    id_task INTEGER REFERENCES task(id_task)
);

-- Table6: invite
DROP TABLE IF EXISTS invite;

CREATE TABLE invite (
    id_invite INTEGER PRIMARY KEY,
    state TEXT NOT NULL,
    date TEXT NOT NULL,
    id_user_sender INTEGER REFERENCES authenticated_user(id_user),
    id_user_receiver INTEGER REFERENCES authenticated_user(id_user)
);

-- Table7: comment
DROP TABLE IF EXISTS comment;

CREATE TABLE comment (
    id_comment INTEGER PRIMARY KEY,
    content TEXT NOT NULL,
    ban BOOL DEFAULT FALSE,
    date DATE NOT NULL,
    id_task INTEGER REFERENCES task(id_task),
    id_user INTEGER REFERENCES authenticated_user(id_user)
);

-- Table8: user_role
DROP TABLE IF EXISTS user_role;

CREATE TABLE user_role (
    role TEXT NOT NULL ,
    id_user INTEGER REFERENCES authenticated_user(id_user),
    id_project INTEGER REFERENCES project(id_project),
    PRIMARY KEY (id_user, id_project)              
);

-- Table9: faq
DROP TABLE IF EXISTS faq;

CREATE TABLE faq (
    id_faq INTEGER PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT
);

-- Table10: ban
DROP TABLE IF EXISTS ban;

CREATE TABLE ban (
    id_ban INTEGER PRIMARY KEY,
    reason TEXT NOT NULL,
    date DATE NOT NULL,
    id_banned INTEGER REFERENCES authenticated_user(id_user),
    id_admin INTEGER REFERENCES administrator(id_admin)
);

-- Table11: notification_user
DROP TABLE IF EXISTS notification_user;

CREATE TABLE notification_user (
    id_user INTEGER REFERENCES authenticated_user(id_user),
    id_notification INTEGER REFERENCES notification(id_notification),
    PRIMARY KEY (id_user, id_notification)              
);

-- Table12: favorite_project
DROP TABLE IF EXISTS favorite_project;

CREATE TABLE favorite_project (
    id_user INTEGER REFERENCES authenticated_user(id_user),
    id_project INTEGER REFERENCES project(id_project),
    PRIMARY KEY (id_user, id_project)              
);

-- Table13: administrator
DROP TABLE IF EXISTS administrator;

CREATE TABLE administrator (
    id_admin INTEGER PRIMARY KEY REFERENCES authenticated_user(id_user)       
);

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;