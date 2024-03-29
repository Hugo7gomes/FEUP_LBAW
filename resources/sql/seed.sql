DROP SCHEMA IF EXISTS lbaw CASCADE;

create schema if not exists lbaw;


DROP TABLE IF EXISTS password_resets CASCADE;
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
DROP TABLE IF EXISTS users CASCADE;


DROP TYPE IF EXISTS task_state;
DROP TYPE IF EXISTS task_priority;
DROP TYPE IF EXISTS user_role;
DROP TYPE IF EXISTS notification_type;
DROP TYPE IF EXISTS invite_state;

DROP FUNCTION IF EXISTS admin_ban_admin CASCADE;
DROP FUNCTION IF EXISTS ban_user_banned CASCADE;
DROP FUNCTION IF EXISTS user_ban_smo CASCADE;
DROP FUNCTION IF EXISTS admin_create_proj CASCADE;
DROP FUNCTION IF EXISTS comment_task CASCADE;
DROP FUNCTION IF EXISTS coordinator_delete_acount CASCADE;
DROP FUNCTION IF EXISTS cannot_invite_collaborator CASCADE;
DROP FUNCTION IF EXISTS update_project_creator CASCADE;
DROP FUNCTION IF EXISTS invite_sender CASCADE;
DROP FUNCTION IF EXISTS check_notification_type CASCADE;
DROP FUNCTION IF EXISTS invite_notification CASCADE;
DROP FUNCTION IF EXISTS comment_notification CASCADE;
DROP FUNCTION IF EXISTS task_assign_notification CASCADE;
DROP FUNCTION IF EXISTS task_assign_update_notification CASCADE;
DROP FUNCTION IF EXISTS assign_task CASCADE;
DROP FUNCTION IF EXISTS project_search_update CASCADE;
DROP FUNCTION IF EXISTS task_search_update CASCADE;




CREATE TYPE task_state AS ENUM ('To Do','Doing','Done');
CREATE TYPE task_priority AS ENUM ('High', 'Medium', 'Low');
CREATE TYPE user_role AS ENUM ('Collaborator', 'Coordinator');
CREATE TYPE notification_type AS ENUM ('Invite', 'Comment', 'Assign', 'TaskState');
CREATE TYPE invite_state AS ENUM ('Received', 'Accepted', 'Rejected');



-----------------------------------------
-- Tables
-----------------------------------------
-- Table1: users

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    email TEXT NOT NULL UNIQUE,
    username VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15),
    deleted BOOL DEFAULT FALSE,
    administrator BOOL DEFAULT FALSE,
    remember_token VARCHAR
);

-- Table2: photo

CREATE TABLE photo (
    id SERIAL PRIMARY KEY,
    path VARCHAR(255) NOT NULL,
    id_user INTEGER NOT NULL REFERENCES users(id)
);

-- Table3: project


CREATE TABLE project (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    details TEXT,
    creation_date DATE NOT NULL,
    archived BOOL NOT NULL DEFAULT FALSE,
    id_creator INTEGER NOT NULL REFERENCES users(id)
);

-- Table4: task


CREATE TABLE task (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    state task_state NOT NULL,
    details TEXT,
    creation_date DATE NOT NULL,
    priority task_priority NOT NULL,
    id_project INTEGER NOT NULL REFERENCES project(id),
    id_user_creator INTEGER NOT NULL REFERENCES users(id),
    id_user_assigned INTEGER REFERENCES users(id)
);

-- Table6: invite


CREATE TABLE invite (
    id SERIAL PRIMARY KEY,
    state invite_state NOT NULL,
    date DATE NOT NULL,
    id_project INTEGER NOT NULL REFERENCES project(id) ,
    id_user_sender INTEGER NOT NULL REFERENCES users(id) ,
    id_user_receiver INTEGER NOT NULL REFERENCES users(id)
);

-- Table7: comment


CREATE TABLE comment (
    id SERIAL PRIMARY KEY,
    comment TEXT NOT NULL,
    ban BOOL DEFAULT FALSE,
    date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
    id_task INTEGER NOT NULL REFERENCES task(id),
    id_user INTEGER NOT NULL REFERENCES users(id)
);

-- Table5: notification


CREATE TABLE notification (
    id SERIAL PRIMARY KEY,
    date DATE NOT NULL,
    type notification_type NOT NULL,
    id_project INTEGER NOT NULL REFERENCES project(id),
    id_invite INTEGER REFERENCES invite(id),
    id_comment INTEGER REFERENCES comment(id),
    id_task INTEGER REFERENCES task(id),
    id_user INTEGER NOT NULL REFERENCES users(id)
);


-- Table8: user_role


CREATE TABLE role (
    role user_role  NOT NULL ,
    id_user INTEGER REFERENCES users(id),
    id_project INTEGER REFERENCES project(id),
    PRIMARY KEY (id_user, id_project)
);

-- Table9: faq


CREATE TABLE faq (
    id SERIAL PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL
);

-- Table10: ban


CREATE TABLE ban (
    id SERIAL PRIMARY KEY,
    reason TEXT NOT NULL,
    date DATE NOT NULL,
    id_banned INTEGER NOT NULL REFERENCES users(id),
    id_admin INTEGER NOT NULL REFERENCES users(id)
);



-- Table12: favorite_proj


CREATE TABLE favorite_proj (
    id_user INTEGER REFERENCES users(id),
    id_project INTEGER REFERENCES project(id),
    PRIMARY KEY (id_user, id_project)
);

CREATE TABLE password_resets (
    email VARCHAR NOT NULL, 
    token VARCHAR NOT NULL ,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL
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
    IF EXISTS (SELECT * FROM users WHERE NEW.id_banned = id AND administrator) THEN
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
    IF EXISTS (SELECT * FROM users WHERE NEW.id_admin = id AND administrator = False) THEN
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
    IF EXISTS (SELECT * FROM users WHERE (SELECT administrator FROM users WHERE NEW.id_creator = id) = TRUE) THEN
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
    IF NOT EXISTS(SELECT * FROM TASK INNER JOIN ROLE USING (id_project) WHERE (SELECT id_project FROM task WHERE NEW.id_task = id) = id_project AND NEW.id_user=id_user)
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
        BEFORE DELETE ON users
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
        'Invite',NEW.id_project, NEW.id,NULL,NULL,NEW.id_user_receiver);
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
        'Comment',(SELECT id_project FROM task WHERE id = NEW.id_task), NULL,NEW.id,NULL,(SELECT id_user_assigned FROM task WHERE id = NEW.id_task));
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
    IF NEW.id_user_assigned IS NOT NULL THEN
    INSERT INTO notification (date, type,id_project,id_invite,id_comment,id_task,id_user) VALUES ( CURRENT_DATE,'Assign',NEW.id_project, NULL,NULL,NEW.id,New.id_user_assigned);
    END IF;
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
    INSERT INTO notification (date, type,id_project,id_invite,id_comment,id_task,id_user) VALUES ( CURRENT_DATE,'Assign',NEW.id_project, NULL,NULL,NEW.id,New.id_user_assigned);

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


INSERT INTO users (email, username, name, password, phone_number) VALUES ('joaoaraujo@gmail.com', 'joaoaraujo76', 'João Araújo', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934212314');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('liavieira@gmail.com', 'liavieira02', 'Lia Vieira', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934772314');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('joaomoreira@gmail.com', 'joaomoreira07', 'João Moreira','$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '944212314');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('hugogomes@gmail.com', 'hugogomes82', 'Hugo Gomes', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934211114');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('diogoneves@gmail.com', 'neves76', 'Diogo Neves', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934212314');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('tiagoaleixo@gmail.com', 'aleixo02', 'Tiago Aleixo', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934772314');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('diogobabo@gmail.com', 'diogo_babo07', 'Diogo Babo','$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '944212314');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('tiagobranquinho@gmail.com', 'branquinho82', 'Tiago Branquinho', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934211114');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('alexandrecorreia@gmail.com', 'alex_correia76', 'Alexandre Correia', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934212314');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('henriquesilva@gmail.com', 'henriquesilva02', 'Henrique Silva', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934772314');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('tiagomartins@gmail.com', 'tiagomartins07', 'Tiago Martins','$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '944212314');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('helenacoelho@gmail.com', 'helenacoelho82', 'Helena Coelho', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934211114');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('zemaciel@gmail.com', 'zemaciel07', 'José Maciel','$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '944212314');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('ruisilveira@gmail.com', 'ruisilveira82', 'Rui Silveira', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934211114');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('mariaalmeida@gmail.com', 'maria_almeida', 'Maria Almeida', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934212315');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('miguelpereira@gmail.com', 'miguel_pereira', 'Miguel Pereira', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934212316');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('danielsantos@gmail.com', 'daniel_santos', 'Daniel Santos', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934212317');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('catarinaribeiro@gmail.com', 'catarina_ribeiro', 'Catarina Ribeiro', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934212318');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('brunosilva@gmail.com', 'bruno_silva', 'Bruno Silva', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934212319');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('joaocarvalho@gmail.com', 'joao_carvalho', 'JoÃ£o Carvalho', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934211300');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('rafaeldias@gmail.com', 'rafael_dias', 'Rafael Dias', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934211301');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('anaoliveira@gmail.com', 'ana_oliveira', 'Ana Oliveira', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934211302');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('filipecosta@gmail.com', 'filipe_costa', 'Filipe Costa', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934211303');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('sararibeiro@gmail.com', 'sara_ribeiro', 'Sara Ribeiro', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934211304');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('mariacosta@gmail.com', 'maria_costa', 'Maria Costa', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934211305');
INSERT INTO users (email, username, name, password, phone_number) VALUES ('luisferreira@gmail.com', 'luis_ferreira', 'Luis Ferreira', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934211306');
INSERT INTO users (email, username, name, password, phone_number, administrator) VALUES ('admin@gmail.com', 'admin1', 'admin', '$2y$10$k0I7hCItv7b8em5tq0byDuz4ujFHGzfWgeXy70MxYzVn6nNmu2y82', '934211114', True);



INSERT INTO project (name, details, creation_date, id_creator) VALUES ('Trabalho de LBAW', 'O intuito do trabalho é desenvolver um site de apoio a workflow de equipas', '2022-10-01', 1);
INSERT INTO project (name, details, creation_date, id_creator) VALUES ('Trabalho de PFL', 'O intuito do trabalho é aprender o conceito de programação funcional em haskell', '2022-10-01', 2);
INSERT INTO project (name, details, creation_date, id_creator) VALUES ('Trabalho de FSI', 'O intuito do trabalho é aprender os conceito de segurança informática','2022-10-01', 3);
INSERT INTO project (name, details, creation_date, id_creator) VALUES ('Trabalho de Redes', 'O intuito do trabalho é desenvolver um protocolo de dados','2022-10-01', 4);
INSERT INTO project (name, details, creation_date, id_creator) VALUES ('Trabalho de IPC', 'O intuito do trabalho é perceber e aperfeiçoar o tópico de user interface','2022-10-01', 2);


INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Estrututa base de dados', 'To Do', 'Ter em atenção as tabelas todas restrições, primary keys, coinstrains etc','2022-10-02','High',1,1,2);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Popular base de dados', 'To Do', 'Pelo menos 5 tuplis por cada tabela','2022-10-02','High',1,1,1);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Main_page', 'To Do', 'Desenvolver a página de entrada do site, adiconar informação sobre o site, contact us etc','2022-10-02','High',1,1,3);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Main_page_design', 'Done', 'A página incial tem de ser chamativa','2022-10-02','High',1,1,4);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Página_projeto', 'To Do', 'Página do projeto, esta página terá de constar os nomes dos participantes bem como as tasks de cada projeto','2022-10-02','High',1,1,2);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Página_perfil', 'To Do', 'Página do perfil é importante ter uma secção de dados pessoais','2022-10-02','High',1,1,3);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Criar página_Projeto', 'To Do', 'Página do perfil é importante ter uma secção de dados pessoais','2022-10-02','High',1,3,8);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Criar página_Administrador', 'To Do', 'Criar perfil de utilizador','2022-10-02','High',1,7,1);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Responsive Design', 'Doing', 'Tornar o css responsivo','2022-10-02','Medium',1,12,4);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('About Page', 'Done', 'Página sobre o que pretende workfluido','2022-10-02','High',1,15,6);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Contact Page', 'To Do', 'Página de contactos do workfluido','2022-10-02','Low',1,2,9);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Comment Tasks', 'Doing', 'Comentar tarefas','2022-10-02','Medium',1,2,2);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Banir Utlizador', 'Done', 'Administrador bane um utilizador','2022-10-02','High',1,3,7);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Autenticação', 'To Do', 'Autenticação login e register','2022-10-02','High',1,11,11);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Gerir Passwords', 'To Do', 'Gerenciar passwords','2022-10-02','High',1,12,13);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Javascript funções', 'Doing', 'Desenvolver funções javascript','2022-10-02','High',1,13,2);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('Editar Projetos', 'To Do', 'Editar projeto','2022-10-02','Medium',1,8,1);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('A1', 'Done', 'Submeter A1','2022-10-02','Low',1,18,12);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('A2', 'Done', 'Submeter A2','2022-10-02','Low',1,19,3);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('A3', 'Done', 'Submeter A3','2022-10-02','Low',1,9,7);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('A4', 'Done', 'Submeter A4','2022-10-02','Low',1,8,8);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('A5', 'Done', 'Submeter A5','2022-10-02','Low',1,15,5);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('A6', 'Done', 'Submeter A6','2022-10-02','Low',1,16,6);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('A7', 'Done', 'Submeter A8','2022-10-02','Low',1,17,7);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('A8', 'Done', 'Submeter A9','2022-10-02','Low',1,18,8);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('A9', 'Doing', 'Submeter A10','2022-10-02','Low',1,19,9);
INSERT INTO task (name,state,details,creation_date,priority,id_project,id_user_creator,id_user_assigned) VALUES ('A10', 'Doing', 'Submeter A10','2022-10-02','Low',1,20,10);


INSERT INTO role (role,id_user,id_project) VALUES ('Coordinator', 1,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Coordinator', 5,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Coordinator',14,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',2,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',3,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',4,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',6,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',7,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',8,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',9,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',10,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',11,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',12,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',13,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',15,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',16,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',17,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',18,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',19,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',20,1);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',2,2);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',3,3);
INSERT INTO role (role,id_user,id_project) VALUES ('Collaborator',4,4);


INSERT INTO faq (question,answer) VALUES ('Como Criar uma conta?', 'Na página incial ou em qualquer página se não tiveres ainda com a conta loggada, no canto superior direito, terás a opção de dar login. Clicar nessa opção que te redirecionará para uma página onde te poderás registar.');
INSERT INTO faq (question,answer) VALUES ('Como Apagar a conta ?', 'Na página do teu perfil encontar lá essa opção.');
INSERT INTO faq (question,answer) VALUES ('Posso apagar a conta sendo coordendor do projeto ?', 'Não, caso sejas coordenador de um projeto apenas poderás apagar a tua conta depois de passares esse cargo a alguém da tua equipa.');
INSERT INTO faq (question,answer) VALUES ('Fui banido, posso aceder à conta ?', 'A nossa equipa conta com administradores, que terão o poder de banir quálquer usuário que faça comentários negativos, ou ponha em causa a ética do website. Uma vez banidos, deixam de poder aceder às vossas contas.');


INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Excelente trabalho, muito bem feito!', '2022-12-17', 1, 2);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Poderias ter dado mais atenção aos detalhes', '2022-11-12', 1, 4);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Trabalho muito fraco, não corresponde ao esperado', '2022-12-22', 1, 1);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Bom trabalho, mas ainda há margem de melhoria', '2022-11-11', 1, 3);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Muito bom, mas há alguns erros que precisam ser corrigidos',     '2023-11-02', 1, 2);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Muito bom trabalho, aprendi muito com ele', '2022-12-07', 1, 5);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Trabalho muito bem feito, parabéns!', '2022-12-05', 2, 4);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Bom trabalho, mas ainda há margem de melhoria', '2022-11-22', 3, 1);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Trabalho excelente, inspirou-me a fazer o meu próprio', '2022-10-11', 4, 2);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Poderias ter dado mais atenção aos detalhes', '2022-10-12', 7, 13);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Trabalho muito fraco, não corresponde ao esperado', '2022-11-22', 8, 12);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Bom trabalho, mas ainda há margem de melhoria', '2022-10-11', 9, 11);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Trabalho excepcional, superou todas as minhas expectativas', '2022-11-01', 10, 7);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Muito bom, mas há alguns erros que precisam ser corrigidos', '2023-12-02', 11, 12);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Muito bom trabalho, aprendi muito com ele', '2022-11-07', 12, 3);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Muito bom trabalho, aprendi muito com ele', '2022-10-07', 13, 8);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Trabalho muito bem feito, parabéns!', '2022-11-05', 2, 4);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Bom trabalho, mas ainda há margem de melhoria', '2022-12-22', 13, 9);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Trabalho excelente, inspirou-me a fazer o meu próprio', '2022-11-11', 3, 10);
INSERT INTO comment (comment,date,id_task,id_user) VALUES ('Muito bom, mas algumas partes poderiam ser mais aprofundadas', '2023-12-03', 4, 7);
