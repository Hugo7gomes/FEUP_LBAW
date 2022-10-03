# ER: Requirements Specification Component

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
| US03       | Consult contacts                                    | medium   | As a user, I want to access the website’s information, so that I can easily ask questions, make suggestions or complain about a service.             |
| US04       | FAQ Page                                            | medium   | As a user, I want to access the FAQ page, so that I can clarify my questions easily.             |

Table 2: User's user stories



**Anonymous User**

| Identifier | Name                       | Priority | Description                                                                                                                                         |
| ---------- | -------------------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| US05       | Sign In                    | high     | As an Anonymous User, I want to authenticate into the system, so that I can access privileged information.                                    |
| US06       | Sign Up                    | high     | As an Anonymous User, I want to register myself into the system, so that I can have my own account.
| US07       | Recover Password           | medium      | As an Anonymous User, I want to authenticate into the system using an external account, so that I can access privileged information.
| US08       | Sign In and Sign Up using external API | low      | As an Anonymous User, I want to authenticate into the system using an external account, so that I can access privileged information.          |

Table 3: Anonymous user's user stories

**Authenticated User**

| Identifier | Name                       | Priority | Description                                                                                                                                         |
| ---------- | -------------------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| US09       | Edit Profile                   | high     | As an Authenticated User, I want to edit my profile, so that I can update my information.                                    |
| US10       | Create Project                    | high     | As an Authenticated User, I want to be able to create a new project, so that I can lead and organize a new team project. |
| US11       | Log out           | high      | As an Authenticated User, I want to log out, so that I can close my account.
| US12       | View Profile | high      | As an Authenticated User, I want to view my profile, so that I can verify if all my information is correct.           |
| US13       | Accept Team Invitations | high     | As an Authenticated User, I want to be able to accept an invitation, so that I can join a team and become a collaborator.          |
| US14       | View projects | high      | As an Authenticated User, I want to view my projects so that I can access them easily.          |
| US15       | Delete Account | medium      |As an Authenticated User, I want to be able to delete my account, so that my profile is deleted from the system.          |
| US16      | View Personal Notifications | medium      | As an Authenticated User, I want to be able to receive personal notifications, so that I am always updated.          |
| US17       | Support Profile Picture  | medium      | As an Authenticated User, I want to be able to upload a profile picture, so that people can see who I am.          |
| US18       | Mark Project as Favorite | medium      | As an Authenticated User, I want to mark project as favorite, so that be easier to identify the most relevant.          |

Table 4: Authenticated user's user stories

**Collaborator**

| Identifier | Name                       | Priority | Description|
| ---------- | -------------------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| US19      | Leave Project                   | high     | As a Collaborator, I want to be able to leave the team, so that I don't belong anymore.                                    |
| US20       | Manage Tasks                   | high     | As a Collaborator, I want to be able to change the tasks details, so that I can manage the priority, labels and due dates of the projects.
| US21      | Create Task            | high      | As a Collaborator, I want to be able to create new tasks, so that I can better organize what needs to be done.
| US22       | View Task Details  | high      | As a Collaborator, I want to see task details, so that I am informed.           |
| US23       | Search Tasks  | high     | As a Collaborator, I want to search tasks, so that get to the task more easily.          |
| US24       | Complete an Assigned Task  | high      | As a Collaborator, I want to complete an assigned task, so that I can update the project progression status.          |
| US25       | Comment on task  | medium      | As a Collaborator, I want to be able to comment on tasks of other team members, so that I can give my opinion. |
| US26       | View project’s team and their profiles   | medium      | As a Collaborator, I want to view my project’s team and their profile, so that I see who is working with me.      |
| US27       | Team Forum  | low      | As a Collaborator, I want to be able to receive and send messages through the team forum, so that I can give my opinion and communicate with other team members.         |

Table 5: Collaborator's user stories

**Coordinator**

| Identifier | Name                       | Priority | Description                                                                                                                                         |
| ---------- | -------------------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| US28       | Add Users to Project                 | high     | As a Coordinator, I want to add users to the project, so that I can add team members to my project.                                  |
| US29       | Assign New Coordinator                  | high     | As a Coordinator, I want to assign a new coordinator, so that I can have a user to help me or to leave that position.
| US30       | Edit Project Details             | high      | As a Coordinator, I want to edit project details, so that the information is updated.
| US31       | Remove project member   | high      |As a Coordinator, I want to remove an element from the team, so that former team members no longer have access to the project.           |
| US32       | Archive Project   | high     | As a Coordinator, I want to archive a project, so that my workspace is organized.         |

Table 6: Coordinator's user stories

**Administrator**

| Identifier | Name                       | Priority | Description                                                                                                                                         |
| ---------- | -------------------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
| US31       | Administrate User Accounts                     | high     | As an Administrator, I want to administrate user accounts, so that I can manage the user’s behavior.                                  |
| US32       | Browse project                   | high     | As an Administrator, I want to browse projects, so that I can easily find one. 
| US33       | View Project Details              | high      | As an Administrator, I want to view the project details, so that I can maintain the website’s quality. 
| US34       | Block and Unblock User Accounts    | high      | As an Administrator, I want to block and unblock user accounts, so that I maintain a standard behavior.            |
| US35       | Delete User Accounts    | high     | As an Administrator, I want to delete user accounts, so that I can keep a clean and friendly website.         |
| US36       | Add FAQ    | medium     | As an Administrator, I want to add a FAQ, so that users dont need to contact me about that subject.         |


Table 7: Administrator's user stories

### 3. Supplementary Requirements

#### 3.1. Business rules
| Identifier | Name                  | Description|
| ---------- | -------------------------- | -------- |
| Br01       | Keep the data even on deletion       | Upon account deletion, shared user data like comments on tasks, chat messages, etc are kept but is made anonymous.|
| Br02       | Administrator account independency       | Administrator accounts are independent of user account. They cannot create or participate in projects.| 
| Br03       |  Unique email      | The same person cannot create two accounts with the same email.| 
| Br04       | Unique nickname       | Two users cannot have the same nickname.| 
| Br05       | Coordinator account deletion      | The coordinator cannot delete his account if he is managing a team. He has to assign that job to someone else in the team before doing so. |  

Table 8: Business rules

#### 3.2. Technical requirements
| Identifier | Name                  | Description|
| ---------- | -------------------------- | -------- |
| TR01       | Availability   | The system must be available 99 percent of the time in each 24-hour period.|
| TR02       | Accessibility       | The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the web browser they use.| 
| **TR03       |  Usability      | The system should be simple because it's a platform for everyone, so it has to be easy to use.**| 
| TR04       | Perdormance       | The system should have response times shorter than 2 s to ensure the user's attention.| 
| TR05       | Web application      | The system should be implemented as a web application with dynamic pages (HTML5, JavaScript, CSS3 and PHP). |
|** TR06       |  Portability      | The server-side system should work across multiple platforms (Linux, Mac OS, etc.) so that everyone can access it, no matter the operating system in question.**| 
| TR07       | Database       | The PostgreSQL database management system must be used, with a version of 11 or higher.| 
| **TR08       | Security      | The system shall protect information from unauthorised access through the use of an authentication and verification system. It is important to ensure that third parties do not have access to projects carried out on our platform, or to impersonate us. ** |
| TR09       |  Robustness      |The system must be prepared to handle and continue operating when runtime errors occur.| 
| TR10       | Scalability       | The system must be prepared to deal with the growth in the number of users and their actions.| 
| TR11       | Ethics      |  The system must respect the ethical principles in software development (for example, personal user details, or usage data, should not be collected nor shared without full acknowledgement and authorization from its owner). |    

Table 9: Technical requirements 

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
GROUP2281, 03/10/2022

* Hugo Gomes up202004343@fe.up.pt
* João Moreira up202005035@fe.up.pt
* João Araújo up202007855@fe.up.pt
* Lia Vieira up202005042@fe.up.pt
