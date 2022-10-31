DROP TABLE IF EXISTS task CASCADE;
DROP TABLE IF EXISTS photo CASCADE;
DROP TABLE IF EXISTS project CASCADE;
DROP TABLE IF EXISTS invite CASCADE;
DROP TABLE IF EXISTS comment CASCADE;
DROP TABLE IF EXISTS notification CASCADE;
DROP TABLE IF EXISTS role CASCADE;
DROP TABLE IF EXISTS faq CASCADE;
DROP TABLE IF EXISTS ban CASCADE;
DROP TABLE IF EXISTS favorite_proj CASCADE;
DROP TABLE IF EXISTS authenticated_user CASCADE;

DROP TYPE IF EXISTS task_state;
DROP TYPE IF EXISTS task_priority;
DROP TYPE IF EXISTS user_role;
DROP TYPE IF EXISTS notification_type;
DROP TYPE IF EXISTS invite_state;

DROP FUNCTION IF EXISTS admin_ban_admin;
DROP FUNCTION IF EXISTS ban_user_banned;
DROP FUNCTION IF EXISTS user_ban_smo;
DROP FUNCTION IF EXISTS admin_create_proj;
DROP FUNCTION IF EXISTS comment_task;
DROP FUNCTION IF EXISTS coordinator_delete_acount;
DROP FUNCTION IF EXISTS cannot_invite_collaborator;
DROP FUNCTION IF EXISTS update_project_creator;
DROP FUNCTION IF EXISTS invite_sender;
DROP FUNCTION IF EXISTS check_notification_type;
DROP FUNCTION IF EXISTS invite_notification;
DROP FUNCTION IF EXISTS comment_notification;
DROP FUNCTION IF EXISTS task_assign_notification;
DROP FUNCTION IF EXISTS task_assign_update_notification;
DROP FUNCTION IF EXISTS assign_task;
DROP FUNCTION IF EXISTS project_search_update;
DROP FUNCTION IF EXISTS task_search_update;




CREATE TYPE task_state AS ENUM ('To Do','Doing','Done');
CREATE TYPE task_priority AS ENUM ('High', 'Medium', 'Low');
CREATE TYPE user_role AS ENUM ('Collaborator', 'Coordinator');
CREATE TYPE notification_type AS ENUM ('Invite', 'Comment', 'Assign', 'TaskState');
CREATE TYPE invite_state AS ENUM ('Received', 'Accepted', 'Rejected');



-----------------------------------------
-- Tables
-----------------------------------------
-- Table1: authenticated_user

CREATE TABLE authenticated_user (
    id_user SERIAL PRIMARY KEY,
    email TEXT NOT NULL UNIQUE,
    username VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15),
    deleted BOOL DEFAULT FALSE,
    administrator BOOL DEFAULT FALSE
);

-- Table2: photo

CREATE TABLE photo (
    id_photo SERIAL PRIMARY KEY,
    path VARCHAR(255) NOT NULL,
    id_user INTEGER NOT NULL REFERENCES authenticated_user(id_user)
);

-- Table3: project


CREATE TABLE project (
    id_project SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    details TEXT,
    creation_date DATE NOT NULL,
    archived BOOL NOT NULL DEFAULT FALSE,
    id_creator INTEGER NOT NULL REFERENCES authenticated_user(id_user)
);

-- Table4: task


CREATE TABLE task (
    id_task SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    state task_state NOT NULL,
    details TEXT,
    creation_date DATE NOT NULL,
    priority task_priority NOT NULL,
    id_project INTEGER NOT NULL REFERENCES project(id_project),
    id_user_creator INTEGER NOT NULL REFERENCES authenticated_user(id_user),
    id_user_assigned INTEGER REFERENCES authenticated_user(id_user)
);

-- Table6: invite


CREATE TABLE invite (
    id_invite SERIAL PRIMARY KEY,
    state invite_state NOT NULL,
    date DATE NOT NULL,
    id_project INTEGER NOT NULL REFERENCES project(id_project) ,
    id_user_sender INTEGER NOT NULL REFERENCES authenticated_user(id_user) ,
    id_user_receiver INTEGER NOT NULL REFERENCES authenticated_user(id_user)
);

-- Table7: comment


CREATE TABLE comment (
    id_comment SERIAL PRIMARY KEY,
    comment TEXT NOT NULL,
    ban BOOL DEFAULT FALSE,
    date DATE NOT NULL,
    id_task INTEGER NOT NULL REFERENCES task(id_task),
    id_user INTEGER NOT NULL REFERENCES authenticated_user(id_user)
);

-- Table5: notification


CREATE TABLE notification (
    id_notification SERIAL PRIMARY KEY,
    date DATE NOT NULL,
    type notification_type NOT NULL,
    id_project INTEGER NOT NULL REFERENCES project(id_project),
    id_invite INTEGER REFERENCES invite(id_invite),
    id_comment INTEGER REFERENCES comment(id_comment),
    id_task INTEGER REFERENCES task(id_task),
    id_user INTEGER NOT NULL REFERENCES authenticated_user(id_user)
);


-- Table8: user_role


CREATE TABLE role (
    role user_role  NOT NULL ,
    id_user INTEGER REFERENCES authenticated_user(id_user),
    id_project INTEGER REFERENCES project(id_project),
    PRIMARY KEY (id_user, id_project)
);

-- Table9: faq


CREATE TABLE faq (
    id_faq SERIAL PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL
);

-- Table10: ban


CREATE TABLE ban (
    id_ban SERIAL PRIMARY KEY,
    reason TEXT NOT NULL,
    date DATE NOT NULL,
    id_banned INTEGER NOT NULL REFERENCES authenticated_user(id_user),
    id_admin INTEGER NOT NULL REFERENCES authenticated_user(id_user)
);



-- Table12: favorite_proj


CREATE TABLE favorite_proj (
    id_user INTEGER REFERENCES authenticated_user(id_user),
    id_project INTEGER REFERENCES project(id_project),
    PRIMARY KEY (id_user, id_project)
);

---------------------------------------------------------------------------------
--Indexes

CREATE INDEX project_tasks ON task USING hash (id_project);
CREATE INDEX user_notifications ON notification USING hash (id_user);
CREATE INDEX task_comments ON comment USING hash (id_task);

ALTER TABLE project
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION project_search_update() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF TG_OP = 'INSERT' THEN
            NEW.tsvectors = (
            setweight(to_tsvector('english', NEW.name), 'A')||
            setweight(to_tsvector('english', NEW.details), 'B') 
            );
    END IF;
    IF TG_OP = 'UPDATE' THEN
            IF (NEW.name <> OLD.name) THEN
                NEW.tsvectors = (
                    setweight(to_tsvector('english', NEW.name), 'A')||
                    setweight(to_tsvector('english', NEW.details), 'B') 
                );
            END IF;
    END IF;
    RETURN NEW;
END 
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER project_search_update
 BEFORE INSERT OR UPDATE ON project
 FOR EACH ROW
 EXECUTE PROCEDURE project_search_update();


CREATE INDEX project_search_idx ON project USING GIN (tsvectors);

ALTER TABLE task
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION task_search_update() RETURNS TRIGGER AS $BODY$
BEGIN
    IF TG_OP = 'INSERT' THEN
            NEW.tsvectors = (
            setweight(to_tsvector('english', NEW.name), 'A') 
            );
    END IF;
    IF TG_OP = 'UPDATE' THEN
            IF (NEW.name <> OLD.name) THEN
                NEW.tsvectors = (
                    setweight(to_tsvector('english', NEW.name), 'A') 
                );
            END IF;
    END IF;
    RETURN NEW;
END $BODY$
LANGUAGE plpgsql;

CREATE TRIGGER task_search_update
 BEFORE INSERT OR UPDATE ON task
 FOR EACH ROW
 EXECUTE PROCEDURE task_search_update();


CREATE INDEX task_search_idx ON task USING GIN (tsvectors);



----------------------------------------------------------------------------------
--TRIGGERS

-- TRIGGER01
CREATE FUNCTION admin_ban_admin() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM authenticated_user WHERE NEW.id_banned = id_user AND administrator) THEN
           RAISE EXCEPTION 'An administrador cannot ban another administrador.';
        END IF;
        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER admin_ban_admin
        BEFORE INSERT OR UPDATE ON ban
        FOR EACH ROW
        EXECUTE PROCEDURE admin_ban_admin();

--------------------------------------------------------------------
--TRIGGER02
CREATE FUNCTION ban_user_banned() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM ban WHERE NEW.id_banned = id_banned) THEN
           RAISE EXCEPTION 'An administrador cannot ban an user that was already banned.';
        END IF;
        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER ban_user_banned
        BEFORE INSERT OR UPDATE ON ban
        FOR EACH ROW
        EXECUTE PROCEDURE ban_user_banned();

-----------------------------------------------------------
--TRIGGER03
CREATE FUNCTION user_ban_smo() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM authenticated_user WHERE NEW.id_admin = id_user AND administrator = False) THEN
           RAISE EXCEPTION 'An user cannot ban someone.';
        END IF;
        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER user_ban_smo
        BEFORE INSERT OR UPDATE ON ban
        FOR EACH ROW
        EXECUTE PROCEDURE user_ban_smo(); 

----------------------------------------------------------------------
--TRIGGER04
CREATE FUNCTION admin_create_proj() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM authenticated_user WHERE (SELECT administrator FROM authenticated_user WHERE NEW.id_creator = id_user) = TRUE) THEN
           RAISE EXCEPTION 'An administrator cannot create a project.';
        END IF;
        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER admin_create_proj
        BEFORE INSERT ON project
        FOR EACH ROW
        EXECUTE PROCEDURE admin_create_proj();

----------------------------------------------------------------
--TRIGGER05
CREATE FUNCTION comment_task() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NOT EXISTS(SELECT * FROM TASK INNER JOIN ROLE USING (id_project) WHERE (SELECT id_project FROM task WHERE NEW.id_task = id_task) = id_project AND NEW.id_user=id_user)
    THEN RAISE EXCEPTION 'A collaborator must be part of that task''s project to able to comment.';

    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER comment_task
       BEFORE INSERT OR UPDATE ON comment
       FOR EACH ROW
       EXECUTE PROCEDURE comment_task();

----------------------------------------------------------
--TRIGGER06       
CREATE FUNCTION coordinator_delete_acount() RETURNS TRIGGER AS
    $BODY$
    BEGIN
    IF EXISTS (SELECT * FROM role WHERE NEW.id_user = id_user AND role.role = 'Coordinator') THEN
           RAISE EXCEPTION 'An coordinator cannot delete his account.';
        END IF;
        RETURN NEW;
    END
    $BODY$
    LANGUAGE plpgsql;

    CREATE TRIGGER coordinator_delete_acount
        BEFORE DELETE ON authenticated_user
        FOR EACH ROW
        EXECUTE PROCEDURE coordinator_delete_acount();

-----------------------------------------------------------
--TRIGGER07
CREATE FUNCTION cannot_invite_collaborator() RETURNS TRIGGER AS
$BODY$
BEGIN 
    IF EXISTS (SELECT * FROM role WHERE NEW.id_user_receiver = id_user AND NEW.id_project = id_project) THEN 
        RAISE EXCEPTION 'User already collaborator';
        END IF;
        RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER cannot_invite_collaborator
        BEFORE INSERT ON invite
        FOR EACH ROW
        EXECUTE PROCEDURE cannot_invite_collaborator();

------------------------------------------------------------
--TRIGGER08
CREATE FUNCTION update_project_creator() RETURNS TRIGGER AS
$BODY$
BEGIN
    RAISE EXCEPTION 'The project creator cannot be updated.';
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER update_project_creator
        BEFORE UPDATE OF id_creator ON project
        FOR EACH ROW
        EXECUTE PROCEDURE update_project_creator();

---------------------------------------------------------------------------------
--TRIGGER09
CREATE FUNCTION invite_sender() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NOT EXISTS (SELECT * FROM role WHERE NEW.id_user_sender = id_user AND NEW.id_project = id_project) THEN
        RAISE EXCEPTION 'Invite sender not a collaborator';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER invite_sender
        BEFORE INSERT ON invite
        FOR EACH ROW
        EXECUTE PROCEDURE invite_sender();

-----------------------------------------------------------------------------------
--TRIGGER10
CREATE FUNCTION check_notification_type() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF (NEW.type = 'Invite' AND (NEW.id_invite IS NULL OR NEW.id_comment IS NOT NULL OR NEW.id_task IS NOT NULL)) THEN
        RAISE EXCEPTION 'Notification invite type wrong';
    END IF;
    IF (NEW.type = 'Comment' AND (NEW.id_comment IS NULL OR NEW.id_task IS NOT NULL OR NEW.id_invite IS NOT NULL)) THEN
        RAISE EXCEPTION 'Notification comment type wrong';
    END IF;
    IF  ((NEW.type = 'Assign' OR NEW.type = 'TaskState') AND (NEW.id_task IS NULL OR NEW.id_comment IS NOT NULL OR NEW.id_invite IS NOT NULL)) THEN
        RAISE EXCEPTION 'Notification task type wrong';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER check_notification_type
        BEFORE INSERT ON notification
        FOR EACH ROW
        EXECUTE PROCEDURE check_notification_type();

-------------------------------------------------------------------------------------
--TRIGGER11
CREATE FUNCTION invite_notification() RETURNS TRIGGER AS
$BODY$
BEGIN
    INSERT INTO notification (date, type,id_project,id_invite,id_comment,id_task,id_user) VALUES (CURRENT_DATE, 
        'Invite',NEW.id_project, NEW.id_invite,NULL,NULL,NEW.id_user_receiver);
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER invite_notification
        AFTER INSERT ON invite
        FOR EACH ROW
        EXECUTE PROCEDURE invite_notification();

------------------------------------------------------------------------------------
--TRIGGER12
CREATE FUNCTION comment_notification() RETURNS TRIGGER AS
$BODY$
BEGIN
    INSERT INTO notification (date, type,id_project,id_invite,id_comment,id_task,id_user) VALUES ( CURRENT_DATE, 
        'Comment',(SELECT id_project FROM task WHERE id_task = NEW.id_task), NULL,NEW.id_comment,NULL,(SELECT id_user_assigned FROM task WHERE id_task = NEW.id_task));
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER comment_notification
        AFTER INSERT ON comment
        FOR EACH ROW
        EXECUTE PROCEDURE comment_notification();

-----------------------------------------------------------------------------------
--TRIGGER13
CREATE FUNCTION task_assign_notification() RETURNS TRIGGER AS
$BODY$
BEGIN
    INSERT INTO notification (date, type,id_project,id_invite,id_comment,id_task,id_user) VALUES ( CURRENT_DATE,'Assign',NEW.id_project, NULL,NULL,NEW.id_task,New.id_user_assigned);

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER task_assign_notification
        AFTER INSERT ON task
        FOR EACH ROW
        EXECUTE PROCEDURE task_assign_notification();

------------------------------------------------------------------------------------
--TRIGGER14
CREATE FUNCTION task_assign_update_notification() RETURNS TRIGGER AS
$BODY$
BEGIN
    INSERT INTO notification (date, type,id_project,id_invite,id_comment,id_task,id_user) VALUES ( CURRENT_DATE,'Assign',NEW.id_project, NULL,NULL,NEW.id_task,New.id_user_assigned);

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER task_assign_update_notification
        AFTER UPDATE OF id_user_assigned ON task
        FOR EACH ROW
        EXECUTE PROCEDURE task_assign_update_notification();

-------------------------------------------------------------------------------------
--TRIGGER15
CREATE FUNCTION assign_task() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NOT EXISTS (SELECT * FROM role WHERE NEW.id_user_assigned = id_user AND NEW.id_project = id_project) THEN
        RAISE EXCEPTION 'User assigned not in the project';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER assign_task
        AFTER UPDATE OF id_user_assigned ON task
        FOR EACH ROW
        EXECUTE PROCEDURE assign_task();