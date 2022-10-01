# ER: Requirements Specification Component

> Project vision.

## A1: Project Management

In a world where teamwork has become crucial to combat the constant adversities that have arisen such as remote work, the need for a project management tool has emerged. So, we decided to create Workfluido.

Workfluido is a web application to help teams plan and manage their projects in a simple and eficient way, making project management less of a chore. 

Our target audience is companies from all sizes and areas but can be used by anyone who needs to manage a team project. It gives our users the ability to organize their workflow by forming teams, assigning tasks and discussing topics with their teams members.

There are four types of roles in workfluido: anonymous users, collaborators, coordinators and administrators. The  anonymous users only have access to the welcome page where they are  presented with a short description of our website and also able to log in or register themselves by e-mail or other platforms such as google or github.

A collaborator has its own profile with a picture and a brief description which can be edited when needed and can be viewed by any other collaborator. Each may be associated with multiple projects at the same time. 

Our application allows any collaborator to create a new team and, by doing so automatically becomes a coordinator of that team. After teams are formed, it is possible to create tasks to be carried out by the team members and change their progression status. 

The coordinator has more privileges than the other team members, such as assigning users to tasks, editing and deleting tasks assigned by others and adding new members to the team. He is also able to change tasks' due dates and their priority.

Each project has a team, task lists and also a discussion forum for members of the project. Each task can have comments made by other collaborators and it is possible to keep track of the user that defined the task as well as the one who completed it. 

At any time, collaborators can view the task details and mark a project as favorite. Users also have the ability to search for specific projects, tasks and messages of the forum and view the list of all the projects that they have participated in, which can be seen in their profile only by them.

Finally, the administrators are the ones responsible for keeping a clean and safe website by administrating user accounts and their respective projects being able to view, change or even delete both of them.


---


## A2: Actors and User stories


### 1. Actors

**User**

| Identifier | Name                                                | Priority | Description                                                                                                                          |
|------------|-----------------------------------------------------|----------|--------------------------------------------------------------------------------------------------------------------------------------|
| US01       | Homepage                                            | high     | As a User, I want to access the home page, so that I can see a brief presentation of the website.                                       |
| US02       | See About                                           | medium   | As a User, I want to access an about page, so that I can see the complete website's description.                                          |
| US03       | Consult contacts                                    | medium   | I want to access the website’s information, so that I can easily ask questions, make suggestions or complain about a service.             |

Table 2: User's user stories



**Anonymous User**

| Identifier | Name                       | Priority | Description                                                                                                                                         |
| ---------- | -------------------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| US04       | Sign In                    | high     | As an Anonymous User, I want to authenticate into the system, so that I can access privileged information.                                    |
| US05       | Sign Up                    | high     | As an Anonymous User, I want to register myself into the system, so that I can have my own account.
| US06       | Recover Password           | medium      | As an Anonymous User, I want to authenticate into the system using an external account, so that I can access privileged information.
| US07       | Sign In using external API | low      | As an Anonymous User, I want to authenticate into the system using an external account, so that I can access privileged information.          |

Table 3: Anonymous user's user stories

**Authenticated User**

| Identifier | Name                       | Priority | Description                                                                                                                                         |
| ---------- | -------------------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| US08       | Edit Profile                   | high     | As an Authenticated User, I want to edit my profile, so that I can update my information.                                    |
| US09       | Create Project                    | high     | As an Authenticated User, I want to be able to create a new project, so that I can lead and organize a new team project. |
| US10       | Log out           | high      | As an Authenticated User, I want to log out, so that I can close my account.
| US11       | View Profile | high      | As an Authenticated User, I want to view my profile, so that I can verify if all my information is correct.           |
| US12       | Accept Team Invitations | high     | As an Authenticated User, I want to be able to accept an invitation, so that I can join a team and become a collaborator.          |
| US13       | View projects | high      | As an Authenticated User, I want to view my projects so that I can access them easily.          |
| US14       | Delete Account | medium      |As an Authenticated User, I want to be able to delete my account, so that my profile is deleted from the system.          |
| US15       | View Personal Notifications | medium      | As an Authenticated User, I want to be able to receive personal notifications, so that I am always updated.          |
| US16       | Support Profile Picture  | medium      | As an Authenticated User, I want to be able to upload a profile picture, so that people can see who I am.          |
| US17       | Mark Project as Favorite | medium      | As an Authenticated User, I want to mark project as favorite, so that be easier to identify the most relevant.          |

Table 4: Authenticated user's user stories

**Collaborator**

| Identifier | Name                       | Priority | Description                                                                                                                                         |
| ---------- | -------------------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| US18       | Leave Project                   | high     | As a Collaborator, I want to be able to leave the team, so that I don't belong anymore.                                    |
| US19       | Manage Tasks                   | high     | As a Collaborator, I want to be able to change the tasks details, so that I can manage the priority, labels and due dates of the projects.
| US20       | Create Task            | high      | As a Collaborator, I want to be able to create new tasks, so that I can better organize what needs to be done.
| US21       | View Task Details  | high      | As a Collaborator, I want to see task details, so that I am informed.           |
| US22       | Search Tasks  | high     | As a Collaborator, I want to search tasks, so that get to the task more easily.          |
| US23       | Complete an Assigned Task  | high      | As a Collaborator, I want to complete an assigned task, so that I can update the project progression status.          |
| US24       | Assign Users to Task  | medium      | As a Collaborator, I want to be able to assign people to tasks, so that the work is split between team members.         |
| US25       | Comment on task  | medium      | As a Collaborator, I want to be able to comment on tasks of other team members, so that I can give my opinion. |
| US26       | View project’s team and their profiles   | medium      | As a Collaborator, I want to view my project’s team and their profile, so that I see who is working with me.      |
| US27       | Team Chat  | medium      | As a Collaborator, I want to be able to receive and send messages through the team chat, so that I can give my opinion and communicate with other team members.         |

Table 5: Collaborator's user stories

**Coordinator**

| Identifier | Name                       | Priority | Description                                                                                                                                         |
| ---------- | -------------------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| US28       | Add Users                    | high     | As a Coordinator, I want to add users to the project, so that I can add team members to my project.                                  |
| US29       | Assign New Coordinator                  | high     | As a Coordinator, I want to assign a new coordinator, so that I can have a user to help me or to leave that position.
| US30       | Edit Project Details             | high      | As a Coordinator, I want to edit project details, so that the information is updated.
| US31       | Remove project member   | high      |As a Coordinator, I want to remove an element from the team, so that former team members no longer have access to the project.           |
| US32       | Archive Project   | high     | As a Coordinator, I want to archive a project, so that my workspace is organized.         |

Table 6: Coordinator's user stories~

**Administrator**

| Identifier | Name                       | Priority | Description                                                                                                                                         |
| ---------- | -------------------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| US31       | Administrate User Accounts                     | high     | As an Administrator, I want to administrate user accounts, so that I can manage the user’s behavior.                                  |
| US32       | Browse project                   | high     | As an Administrator, I want to browse projects, so that I can easily find one. 
| US33       | View Project Details              | high      | As an Administrator, I want to view the project details, so that I can maintain the website’s quality. 
| US34       | Block and Unblock User Accounts    | high      | As an Administrator, I want to block and unblock user accounts, so that I maintain a standard behavior.            |
| US35       | Delete User Accounts    | high     | As an Administrator, I want to delete user accounts, so that I can keep a clean and friendly website.         |

Table 7: Administrator's user stories

### 3. Supplementary Requirements

> Section including business rules, technical requirements, and restrictions.  
> For each subsection, a table containing identifiers, names, and descriptions for each requirement.

#### 3.1. Business rules

#### 3.2. Technical requirements

#### 3.3. Restrictions


---


## A3: Information Architecture

> Brief presentation of the artefact goals.


### 1. Sitemap

> Sitemap presenting the overall structure of the web application.  
> Each page must be identified in the sitemap.  
> Multiple instances of the same page (e.g. student profile in SIGARRA) are presented as page stacks.


### 2. Wireframes

> Wireframes for, at least, two main pages of the web application.
> Do not include trivial use cases.


#### UIxx: Page Name

#### UIxx: Page Name


---


## Revision history

Changes made to the first submission:
1. Item 1
1. ...

***
GROUP21gg, DD/MM/2021

* Group member 1 name, email (Editor)
* Group member 2 name, email
* ...
