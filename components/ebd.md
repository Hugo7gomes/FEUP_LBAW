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
| R01               | authenticated_user(**id_user**, email UK NN, username UK NN, name NN, password NN, phone_number, administrator NN,deleted) |
| R02               | photo(**id_photo**, path NN, id_user->authenticated_user NN) |
| R03               | project(**id_project**, name NN, details, creation_date NN, archived NN) |
| R04               | task(**id_task**, name NN, state NN CK state IN State DF 'To do', creation_date NN, priority NN CK priority IN Priority, id_user->authenticated_user, proj_id->project) |
| R05               | notification(**id_notification**, date NN, type NN CK type IN Type, id_project->project) |
| R06               | invite(**id_invite**, state NN, date NN, id_user_sender->authenticated_user, id_userReceiver->authenticated_user) |
| R07               | comment(**id_comment**, comment NN, date NN, ban, id_task->task) |
| R08               | role(**idUser**->authenticated_user, **id_project**->project, role NN CK role IN Role ) |
| R09               | faq(**id_question**, question NN, answer NN) |
| R10               | ban(**id_ban**, reason NN, date NN) |
| R11               | notification_user(**id_user**->authenticated_user, **id_notification**->notification)  |
| R12               | favorite_project(**id_user**->authenticated_user, **id_project**->project)  |
| R13               | bans(**id_ban**->ban, id_user->authenticated_user)  |

ver estas:
| R12               | taskTStateNotification(**idUser**->authenticatedUser, **idNotification**->notification UK)  |
| R14               | taskAssignNotification(**idUser**->authenticatedUser, **idNotification**->notification UK)   |
| R15               | commentCNotification(**idUser**->authenticatedUser, **idNotification**->notification UK)   |
| R16               | inviteINotification(**idUser**->authenticatedUser, **idNotification**->notification UK) |


Legend:
UK = UNIQUE KEY
NN = NOT NULL
DF = DEFAULT
CK = CHECK.

### 2. Domains

> The specification of additional domains can also be made in a compact form, using the notation:  

| Domain Name | Domain Specification           |
| ----------- | ------------------------------ |
| State	      | ENUM ('To do', 'Doing','Done')      |
| Priority    | ENUM ('High', 'Medium', 'Low') |
| Role    | ENUM ('Collaborator', 'Coordinator') |
| Type    | ENUM ('Invite', 'Comment', 'Assign', 'TaskState') |

### 3. Schema validation

> To validate the Relational Schema obtained from the Conceptual Model, all functional dependencies are identified and the normalization of all relation schemas is accomplished. Should it be necessary, in case the scheme is not in the Boyce–Codd Normal Form (BCNF), the relational schema is refined using normalization.  

| **TABLE R01**   | User               |
| --------------  | ---                |
| **Keys**        | { id }, { email }  |
| **Functional Dependencies:** |       |
| FD0101          | id → {email, name} |
| FD0102          | email → {id, name} |
| ...             | ...                |
| **NORMAL FORM** | BCNF               |

> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF.  


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
