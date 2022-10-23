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
| R01               | authenticated_user(**id_user**, email UK NN, username UK NN, name NN, password NN, phone_number,deleted) |
| R02               | photo(**id_photo**, path NN, id_user->authenticated_user NN) |
| R03               | project(**id_project**, name NN, details, creation_date NN, archived NN, id_project_creator->authenticated_user) |
| R04               | task(**id_task**, name NN, state NN CK state IN State DF 'To do',details, creation_date NN, priority NN CK priority IN Priority, id_user_assigned->authenticated_user,id_user_creator->authenticated_user NN, proj_id->project NN) |
| R05               | notification(**id_notification**, date NN, type NN CK type IN Type, id_project->project NN, id_invite->invite, id_comment->comment, id_task->task) |
| R06               | invite(**id_invite**, state NN, date NN, id_project->project NN, id_user_sender->authenticated_user NN, id_userReceiver->authenticated_user NN) |
| R07               | comment(**id_comment**, comment NN, date NN, ban DF FALSE, id_task->task NN, id_user ->authenticated_user NN) |
| R08               | role(**id_user**->authenticated_user, **id_project**->project, role NN CK role IN Role ) |
| R09               | faq(**id_question**, question NN, answer NN) |
| R10               | ban(**id_ban**, reason NN, date NN,id_banned->authenticated_user NN, id_admin->administrator NN) |
| R11               | notified(**id_user**->authenticated_user, **id_notification**->notification)  |
| R12               | favorite_proj(**id_user**->authenticated_user, **id_project**->project)  |
| R13               | administrator( **id_user**->authenticated_user)  |



Legend:
UK = UNIQUE KEY
NN = NOT NULL
DF = DEFAULT
CK = CHECK

### 2. Domains

> The specification of additional domains can also be made in a compact form, using the notation:  

| Domain Name | Domain Specification           |
| ----------- | ------------------------------ |
| State	      | ENUM ('To do', 'Doing','Done')      |
| Priority    | ENUM ('High', 'Medium', 'Low') |
| Role    | ENUM ('Collaborator', 'Coordinator') |
| Type    | ENUM ('Invite', 'Comment', 'Assign', 'TaskState') |

### 3. Schema validation

| Table R01 (authenticated_users)                    |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_user }, { username }, { email }, {phone_number}     |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0101                                             | { id } :- { name, username, email, password, phone_number, deleted } |
| FD0102                                             | { username } :- { name, id, email, password, phone_number, deleted } |
| FD0103                                             | { email } :- { name, username, id, password, phone_number, deleted } |
| FD0104                                             | { phone_number } :- { name, username, id, password, email, deleted } |
| **Normal Form**                                    | BCNF                                               |


| Table R02 (photo)                                  |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_photo }, { id_user }                |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0201                                             | { id_photo } :- {id_user, path} |
| FD0202                                             | { id_user }  :-  {id_photo, path} |
| **Normal Form**                                    | BCNF                                               |


| Table R03 (project)                                |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_project }                           |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0301                                             | { id_project } :- {name, details,creation_date,archived,id_creator}                  |
| **Normal Form**                                    | BCNF                                               |

| Table R04 (task)                                   |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_task }                              |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0401                                             | { id_photo } :- {name, task_state,details,creation_date,task_priority,archived,id_project,id_user_creator,id_user_assigned}                    |
| **Normal Form**                                    | BCNF                                               |

| Table R05 (notification)                           |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_notification }                      |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0501                                             | { id_notification } :- {date,notification_type,id_project,id_invite,id_comment,id_task} |
| **Normal Form**                                    | BCNF                                               |

| Table R06 (invite)                                 |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_invite }                            |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0601                                             | { id_invite } :- {invite_state,date,id_user_sender,id_user_receiver} |
| **Normal Form**                                    | BCNF                                               |

| Table R07 (comment)                                |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_comment }                           |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0701                                             | { id_comment } :- {comment, ban, date, id_task, id_user}                    |
| **Normal Form**                                    | BCNF                                               |

| Table R08 (role)                                   |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_user, id_project }                  |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0801                                             | { id_user,id_project } :- {user_role}              |
| **Normal Form**                                    | BCNF                                               |

| Table R09 (faq)                                    |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_faq }, { question,answer }          |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD0901                                             | { id_faq } :- {question,answer}                    |
| FD0902                                             | { question,answer }  :-  {id_faq}                  |
| **Normal Form**                                    | BCNF                                               |

| Table R10 (ban)                                    |                                                    |
|----------------------------------------------------|----------------------------------------------------|
| **Keys:** { id_ban }, { id_admin,id_banned,date }  |                                                    |
| **Functional Dependencies**                        |                                                    |
| FD1001                                             | { id_ban } :- {id_admin,id_banned,date,reason}     |
| FD1002                                             | { id_admin, id_banned, date}  :-  {id_ban, reason} |
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
| ------------------ | ------------- | ------------------------- | -------- |
| R01                | Table1        | units|dozens|hundreds|etc | order per time |
| R02                | Table2        | units|dozens|hundreds|etc | dozens per month |
| R03                | Table3        | units|dozens|hundreds|etc | hundreds per day |
| R04                | Table4        | units|dozens|hundreds|etc | no growth |


### 2. Proposed Indices

#### 2.1. Performance Indices
 
> Indices proposed to improve performance of the identified queries.

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | Relation where the index is applied    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | B-tree, Hash, GiST or GIN              |
| **Cardinality**     | Attribute cardinality: low/medium/high |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
| `SQL code`                                                  ||


#### 2.2. Full-text Search Indices 

> The system being developed must provide full-text search features supported by PostgreSQL. Thus, it is necessary to specify the fields where full-text search will be available and the associated setup, namely all necessary configurations, indexes definitions and other relevant details.  

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | Relation where the index is applied    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | B-tree, Hash, GiST or GIN              |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
| `SQL code`                                                  ||


### 3. Triggers
 
> User-defined functions and trigger procedures that add control structures to the SQL language or perform complex computations, are identified and described to be trusted by the database server. Every kind of function (SQL functions, Stored procedures, Trigger procedures) can take base types, composite types, or combinations of these as arguments (parameters). In addition, every kind of function can return a base type or a composite type. Functions can also be defined to return sets of base or composite values.  

| **Trigger**      | TRIGGER01                              |
| ---              | ---                                    |
| **Description**  | Trigger description, including reference to the business rules involved |
| `SQL code`                                             ||

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
