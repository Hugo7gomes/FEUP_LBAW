# EBD: Database Specification Component

> Project vision.

## A4: Conceptual Data Model

> Brief presentation of the artefact goals.
A Conceptual Data Model is an organized view of database concepts and their relationships. The purpose of creating a conceptual data model is to establish entities, their attributes, and relationships. In this data modeling level, there is hardly any detail available on the actual database structure. Business stakeholders and data architects typically create a conceptual data model.

The Conceptual Data Model contains the identification and description of the entities, the relationships between them in a UML Class diagram

### 1. Class diagram

> UML class diagram containing the classes, associations, multiplicity and roles.  
> For each class, the attributes, associations and constraints are included in the class diagram.

### 2. Additional Business Rules
 
> Business rules can be included in the UML diagram as UML notes or in a table in this section.


---


## A5: Relational Schema, validation and schema refinement

> Brief presentation of the artefact goals.

### 1. Relational Schema

> The Relational Schema includes the relation schemas, attributes, domains, primary keys, foreign keys and other integrity rules: UNIQUE, DEFAULT, NOT NULL, CHECK.  
> Relation schemas are specified in the compact notation:  

| Relation reference| Relation Compact Notation                        |
| ------------------| ------------------------------------------------ |
| R01               | authenticated_user(**id_user**, email UK NN, username UK NN, name NN, password NN, phone_number, deleted, administrator) |
| R02               | photo(**id_photo**, path NN, id_user->authenticated_user NN) |
| R03               | project(**id_project**, name NN, details, creation_date NN, archived NN DF 'False', id_project_creator->authenticated_user) |
| R04               | task(**id_task**, name NN, state NN CK state IN task_state DF 'To do', details, creation_date NN, priority NN CK task_priority IN priority, id_user_assigned->authenticated_user,id_user_creator->authenticated_user NN, id_project->project NN) |
| R05               | notification(**id_notification**, date NN, type NN CK type IN notification_type, id_project->project NN, id_invite->invite, id_comment->comment, id_task->task, id_user->authenticated_user NN) |
| R06               | invite(**id_invite**, state NN CK state IN invite_state DF 'Received', date NN, id_project->project NN, id_user_sender->authenticated_user NN, id_user_receiver->authenticated_user NN) |
| R07               | comment(**id_comment**, comment NN, date NN, ban DF FALSE, id_task->task NN, id_user ->authenticated_user NN) |
| R08               | role(**id_user**->authenticated_user, **id_project**->project, role NN CK role IN user_role ) |
| R09               | faq(**id_faq**, question NN, answer NN) |
| R10               | ban(**id_ban**, reason NN, date NN, id_banned->authenticated_user NN, id_admin->authenticated_user NN) |
| R11               | favorite_proj(**id_user**->authenticated_user, **id_project**->project)  |


Legend:
UK = UNIQUE KEY
NN = NOT NULL
DF = DEFAULT
CK = CHECK

### 2. Domains

> The specification of additional domains can also be made in a compact form, using the notation:  

| Domain Name | Domain Specification           |
| ----------- | ------------------------------ |
| task_state	      | ENUM ('To do', 'Doing','Done')      |
| task_priority    | ENUM ('High', 'Medium', 'Low') |
| user_role    | ENUM ('Collaborator', 'Coordinator') |
| notification_type    | ENUM ('Invite', 'Comment', 'Assign', 'TaskState') |
| invite_state    | ENUM ('Received', 'Accepted', 'Rejected') |


### 3. Schema validation

| Table R01 (authenticated_users)                    |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_user }, { username }, { email }, {phone_number}     |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0101                                             | { id_user } :- { name, username, email, password, phone_number, deleted } |
| FD0102                                             | { username } :- { name, id, email, password, phone_number, deleted } |
| FD0103                                             | { email } :- { name, username, id, password, phone_number, deleted } |
| FD0104                                             | { phone_number } :- { name, username, id, password, email, deleted } |
| **Normal Form**                                    | BCNF                                               |


| Table R02 (photo)                                  |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_photo }, { id_user }                |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0201                                             | { id_photo } :- { id_user, path } |
| FD0202                                             | { id_user }  :-  { id_photo, path } |
| **Normal Form**                                    | BCNF                                               |


| Table R03 (project)                                |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_project }                           |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0301                                             | { id_project } :- { name, details,creation_date,archived,id_creator }                  |
| **Normal Form**                                    | BCNF                                               |

| Table R04 (task)                                   |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_task }                              |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0401                                             | { id_task } :- { name, task_state,details,creation_date,task_priority,archived,id_project,id_user_creator,id_user_assigned }                    |
| **Normal Form**                                    | BCNF                                               |

| Table R05 (notification)                           |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_notification }                      |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0501                                             | { id_notification } :- { date,notification_type,id_project,id_invite,id_comment,id_task } |
| **Normal Form**                                    | BCNF                                               |

| Table R06 (invite)                                 |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_invite }                            |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0601                                             | { id_invite } :- { invite_state,date,id_user_sender,id_user_receiver } |
| **Normal Form**                                    | BCNF                                               |

| Table R07 (comment)                                |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_comment }                           |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0701                                             | { id_comment } :- { comment, ban, date, id_task, id_user }                    |
| **Normal Form**                                    | BCNF                                               |

| Table R08 (role)                                   |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_user, id_project }                  |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0801                                             | { id_user,id_project } :- { user_role }            |
| **Normal Form**                                    | BCNF                                               |

| Table R09 (faq)                                    |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_faq }, { question,answer }          |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0901                                             | { id_faq } :- { question,answer }                  |
| FD0902                                             | { question,answer }  :-  { id_faq }                |
| **Normal Form**                                    | BCNF                                               |

| Table R10 (ban)                                    |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_ban }, { id_banned }                |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD1001                                             | { id_ban } :- {id_admin,id_banned,date,reason}     |
| FD1002                                             | { id_banned } :- {id_ban, reason, date, id_admin, }|
| **Normal Form**                                    | BCNF                                               |

| Table R11 (notified)                               |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_user,id_notification }              |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD1101                                             | { id_user,id_notification } :- {}                  |
| **Normal Form**                                    | BCNF                                               |

| Table R12 (favorite_proj)                          |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_user,id_project }                   |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD1201                                             | { id_user,id_project } :- {}                       |
| **Normal Form**                                    | BCNF                                               |

| Table R13 (administrator)                          |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_admin}                              |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD1301                                             | { id_admin } :- {}                                 |
| **Normal Form**                                    | BCNF                                               |


---


## A6: Indexes, triggers, transactions and database population

> Brief presentation of the artefact goals.

### 1. Database Workload
 
> A study of the predicted system load (database load).
> Estimate of tuples at each relation.

| **Relation reference** | **Relation Name** | **Order of magnitude**        | **Estimated growth** |
| ---------------------- | ------------- ----| ------------------------------| ---------------------|
| R01                    | authenticated_user| units|dozens|hundreds|etc     | order per time       |
| R02                    | photo             | units|dozens|hundreds|etc     | dozens per month     |
| R03                    | project           | units|dozens|hundreds|etc     | hundreds per day     |
| R04                    | task              | units|dozens|hundreds|etc     | no growth            |
| R05                    | notification      | units|dozens|hundreds|etc     | dozens per month     |
| R06                    | invite            | units|dozens|hundreds|etc     | hundreds per day     |
| R07                    | comment           | units|dozens|hundreds|etc     | no growth            |
| R08                    | role              | units|dozens|hundreds|etc     | dozens per month     |
| R09                    | faq               | units|dozens|hundreds|etc     | hundreds per day     |
| R10                    | ban               | units|dozens|hundreds|etc     | no growth            |
| R11                    | notified          | units|dozens|hundreds|etc     | dozens per month     |
| R12                    | favorite_proj     | units|dozens|hundreds|etc     | hundreds per day     |
| R13                    | admin             | units|dozens|hundreds|etc     | no growth            |


### 2. Proposed Indices

#### 2.1. Performance Indices
 
> Indices proposed to improve performance of the identified queries.

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | project                                |
| **Attribute**       | name                                   |
| **Type**            | type                                   |
| **Cardinality**     | low/medium/high                        |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
| 'SQL CODE'                                                   ||

| **Index**           | IDX02                                  |
| ---                 | ---                                    |
| **Relation**        | project                                |
| **Attribute**       | name                                   |
| **Type**            | type                                   |
| **Cardinality**     | low/medium/high                        |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
| 'SQL CODE'                                                   ||

| **Index**           | IDX03                                  |
| ---                 | ---                                    |
| **Relation**        | project                                |
| **Attribute**       | name                                   |
| **Type**            | type                                   |
| **Cardinality**     | low/medium/high                        |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
| 'SQL CODE'                                                   ||



#### 2.2. Full-text Search Indices 

> The system being developed must provide full-text search features supported by PostgreSQL. Thus, it is necessary to specify the fields where full-text search will be available and the associated setup, namely all necessary configurations, indexes definitions and other relevant details.  

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | project                                |
| **Attribute**       | name                                   |
| **Type**            | GIN                                    |
| **Clustering**      | Clustering of the index                |
| **Justification**   | To provide full-text search features to look for projects based on their names. The index type is GIN because the indexed fields are not expected to change more than the times they are visit .    |

**SQL CODE**
```sql
ALTER TABLE project
ADD COLUMN tsvectors TSVECTOR;

CREATE FUNCTION project_search_update() RETURNS TRIGGER AS 
$BODY$
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
END 
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER project_search_update
 BEFORE INSERT OR UPDATE ON project
 FOR EACH ROW
 EXECUTE PROCEDURE project_search_update();


CREATE INDEX project_search_idx ON project USING GIN (tsvectors);
```

| **Index**           | IDX02                                  |
| ---                 | ---                                    |
| **Relation**        | task    |
| **Attribute**       | name   |
| **Type**            | GIN              |
| **Clustering**      | Clustering of the index                |
| **Justification**   | To provide full-text search features to look for users based on their names. The index type is GIN because the indexed fields are not expected to change so much as the times they are visit .    |

**SQL CODE**
```sql
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
```                                                             


### 3. Triggers
 
> User-defined functions and trigger procedures that add control structures to the SQL language or perform complex computations, are identified and described to be trusted by the database server. Every kind of function (SQL functions, Stored procedures, Trigger procedures) can take base types, composite types, or combinations of these as arguments (parameters). In addition, every kind of function can return a base type or a composite type. Functions can also be defined to return sets of base or composite values.  

| **Trigger**      | admin_ban_admin                              |
| ---              | ---                                    |
| **Description**  | An administrator cannot ban another administrator ||

```sql
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
```    

| **Trigger**      | ban_user_banned                              |
| ---              | ---                                    |
| **Description**  | An administrator cannot ban someone who was already banned ||

```sql
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
```    

| **Trigger**      | user_ban_smo                              |
| ---              | ---                                    |
| **Description**  | An authenticated user cannot ban or unban someone ||

```sql
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
```    

| **Trigger**      | admin_create_proj                              |
| ---              | ---                                    |
| **Description**  | An administrator cannot create a project ||

```sql
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
``` 

| **Trigger**      | collaborator_comment_task                              |
| ---              | ---                                    |
| **Description**  | Only a collaborator of a project can comment a task of that project ||

```sql
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
``` 

| **Trigger**      | coordinator_delete_acount                              |
| ---              | ---                                    |
| **Description**  | A coordinator cannot delete his account ||

```sql
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

``` 

| **Trigger**      | cannot_invite_collaborator                         |
| ---              | ---                                    |
| **Description**  | Cannot invite an user that's already on the team||

```sql
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
``` 

| **Trigger**      | update_project_creator                         |
| ---              | ---                                    |
| **Description**  | Project creator cannot be updated ||

```sql
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
        EXECUTE PROCEDURE update_project_creator()
``` 

| **Trigger**      | invite_sender                         |
| ---              | ---                                    |
| **Description**  | Invite sender needs to be a collaborator of the project ||

```sql
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
        EXECUTE PROCEDURE invite_sender()
```

### 4. Transactions
 
> Transactions needed to assure the integrity of the data.  

| SQL Reference   | Transaction Name                    |
| --------------- | ----------------------------------- |
| Justification   | Justification for the transaction.  |
| Isolation level | Isolation level of the transaction. |
| `Complete SQL Code`                                   ||


## Annex A. SQL Code

> The database scripts are included in this annex to the EBD component.
> 
> The database creation script and the population script should be presented as separate elements.
> The creation script includes the code necessary to build (and rebuild) the database.
> The population script includes an amount of tuples suitable for testing and with plausible values for the fields of the database.
>
> The complete code of each script must be included in the group's git repository and links added here.

### A.1. Database schema

> The complete database creation must be included here and also as a script in the repository.

### A.2. Database population

> Only a sample of the database population script may be included here, e.g. the first 10 lines. The full script must be available in the repository.

---


## Revision history

Changes made to the first submission:
1. Item 1
1. ..

***
GROUP2281, 13/10/2022

* Hugo Gomes up202004343@fe.up.pt
* João Moreira up202005035@fe.up.pt
* João Araújo up202007855@fe.up.pt (Editor)
* Lia Vieira up202005042@fe.up.pt
