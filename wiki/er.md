# ER: Requirements Specification Component

## A1: Project Management

In a world where teamwork has become crucial to combat the constant adversities that have arisen such as remote work, the need for a project management tool has emerged. So, we decided to create Workfluido.

Workfluido is a web application to help teams plan and manage their projects in a simple and eficient way, making project management less of a chore.

Our target audience is companies from all sizes and areas but can be used by anyone who needs to manage a team project. It gives our users the ability to organize their workflow by forming teams, assigning tasks and discussing topics with their teams members.

There are four types of roles in workfluido: anonymous users, collaborators, coordinators and administrators. The anonymous users only have access to the welcome page where they are presented with a short description of our website and also able to log in or register themselves by e-mail or other platforms such as google or github.

A collaborator has its own profile with a picture and a brief description which can be edited when needed and can be viewed by any other collaborator. Each may be associated with multiple projects at the same time.

Our application allows any collaborator to create a new team and, by doing so automatically becomes a coordinator of that team. After teams are formed, it is possible to create tasks to be carried out by the team members and change their progression status.

The coordinator has more privileges than the other team members, such as assigning users to tasks, editing and deleting tasks assigned by others and adding new members to the team. He is also able to change tasks' due dates and their priority.

Each project has a team, task lists and also a discussion forum for members of the project. Each task can have comments made by other collaborators and it is possible to keep track of the user that defined the task as well as the one who completed it.

At any time, collaborators can view the task details and mark a project as favorite. Users also have the ability to search for specific projects, tasks and messages of the forum and view the list of all the projects that they have participated in, which can be seen in their profile only by them.

Finally, the administrators are the ones responsible for keeping a clean and safe website by administrating user accounts and their respective projects being able to view, change or even delete both of them.

---

## A2: Actors and User stories

The following sections provide detailed information about our project such as Actors, User Stories and Supplementary requirements.

### 1. Actors

![image](uploads/46d64a0bcde762441530788519a5cc3d/image.png)

_Figure 1_: Actors

| Identifier | Description |
|------------|-------------|
| User | Generic user that has access to public information. |
| Anonymous User | User that can create an account or log-in. |
| Authenticated User | User that can manage their personal information and accept team invitations. |
| Coordinator | Authenticated user that manages the rest of the team and which has features such as editing and deleting tasks assigned by others users, adding and removing collaborators. |
| Collaborator | Authenticated user that can check the workflow of the teams to which they belong, change their task state and comment the tasks performed by others. |
| Administrator | Authenticated user that is responsible for the management of users and has some moderation functions. |
| OAuth API | External OAuth API that can be used to authenticate into the system. |

Table 1: Workfluido actors description

**User**

| Identifier | Name | Priority | Description |
|------------|------|----------|-------------|
| US01 | Homepage | high | As a User, I want to access the home page, so that I can see a brief presentation of the website. |
| US02 | See About | medium | As a User, I want to access an about page, so that I can see the complete website's description. |
| US03 | Consult contacts | medium | As a user, I want to access the website’s information, so that I can easily ask questions, make suggestions or complain about a service. |
| US04 | FAQ Page | medium | As a user, I want to access the FAQ page, so that I can clarify my questions easily. |

Table 2: User's user stories

**Anonymous User**

| Identifier | Name | Priority | Description |
|------------|------|----------|-------------|
| US05 | Sign In | high | As an Anonymous User, I want to authenticate into the system, so that I can access privileged information. |
| US06 | Sign Up | high | As an Anonymous User, I want to register myself into the system, so that I can have my own account. |
| US07 | Recover Password | medium | As an Anonymous User, I want to authenticate into the system using an external account, so that I can access privileged information. |
| US08 | Sign In and Sign Up using external API | low | As an Anonymous User, I want to authenticate into the system using an external account, so that I can access privileged information. |

Table 3: Anonymous user's user stories

**Authenticated User**

| Identifier | Name | Priority | Description |
|------------|------|----------|-------------|
| US09 | Edit Profile | high | As an Authenticated User, I want to edit my profile, so that I can update my information. |
| US10 | Create Project | high | As an Authenticated User, I want to be able to create a new project, so that I can lead and organize a new team project. |
| US11 | Log out | high | As an Authenticated User, I want to log out, so that I can close my account. |
| US12 | View Profile | high | As an Authenticated User, I want to view my profile, so that I can verify if all my information is correct. |
| US13 | Accept Team Invitations | high | As an Authenticated User, I want to be able to accept an invitation, so that I can join a team and become a collaborator. |
| US14 | View projects | high | As an Authenticated User, I want to view my projects so that I can access them easily. |
| US15 | View Personal Notifications | high | As an Authenticated User, I want to be able to receive personal notifications, so that I am always updated. |
| US16 | Delete Account | medium | As an Authenticated User, I want to be able to delete my account, so that my profile is deleted from the system. |
| US17 | Support Profile Picture | medium | As an Authenticated User, I want to be able to upload a profile picture, so that people can see who I am. |
| US18 | Mark Project as Favorite | medium | As an Authenticated User, I want to mark project as favorite, so that be easier to identify the most relevant. |

Table 4: Authenticated user's user stories

**Collaborator**

| Identifier | Name | Priority | Description |
|------------|------|----------|-------------|
| US19 | Leave Project | high | As a Collaborator, I want to be able to leave the team, so that I don't belong anymore. |
| US20 | Manage Tasks | high | As a Collaborator, I want to be able to change the tasks details, so that I can manage the priority, labels and due dates of the projects. |
| US21 | Create Task | high | As a Collaborator, I want to be able to create new tasks, so that I can better organize what needs to be done. |
| US22 | View Task Details | high | As a Collaborator, I want to see task details, so that I am informed. |
| US23 | Search Tasks | high | As a Collaborator, I want to search tasks, so that get to the task more easily. |
| US24 | Complete an Assigned Task | high | As a Collaborator, I want to complete an assigned task, so that I can update the project progression status. |
| US25 | Comment on task | medium | As a Collaborator, I want to be able to comment on tasks of other team members, so that I can give my opinion. |
| US26 | View project’s team and their profiles | medium | As a Collaborator, I want to view my project’s team and their profile, so that I see who is working with me. |
| US27 | Team Forum | low | As a Collaborator, I want to be able to receive and send messages through the team forum, so that I can give my opinion and communicate with other team members. |

Table 5: Collaborator's user stories

**Coordinator**

| Identifier | Name | Priority | Description |
|------------|------|----------|-------------|
| US28 | Add Users to Project | high | As a Coordinator, I want to add users to the project, so that I can add team members to my project. |
| US29 | Assign New Coordinator | high | As a Coordinator, I want to assign a new coordinator, so that I can have a user to help me or to leave that position. |
| US30 | Edit Project Details | high | As a Coordinator, I want to edit project details, so that the information is updated. |
| US31 | Remove project member | high | As a Coordinator, I want to remove an element from the team, so that former team members no longer have access to the project. |
| US32 | Archive Project | high | As a Coordinator, I want to archive a project, so that my workspace is organized. |

Table 6: Coordinator's user stories

**Administrator**

| Identifier | Name | Priority | Description |
|------------|------|----------|-------------|
| US33 | Administrate User Accounts | medium | As an Administrator, I want to administrate user accounts, so that I can manage the user’s behavior. |
| US34 | Browse project | medium | As an Administrator, I want to browse projects, so that I can easily find one. |
| US35 | View Project Details | medium | As an Administrator, I want to view the project details, so that I can maintain the website’s quality. |
| US36 | Block and Unblock User Accounts | medium | As an Administrator, I want to block and unblock user accounts, so that I maintain a standard behavior. |
| US37 | Delete User Accounts | medium | As an Administrator, I want to delete user accounts, so that I can keep a clean and friendly website. |
| US38 | Add FAQ | medium | As an Administrator, I want to add a FAQ, so that users dont need to contact me about that subject. |

Table 7: Administrator's user stories

### 3. Supplementary Requirements

#### 3.1. Business rules

| Identifier | Name | Description |
|------------|------|-------------|
| Br01 | Keep the data even on deletion | Upon account deletion, shared user data like comments on tasks, chat messages, etc are kept but is made anonymous. |
| Br02 | Administrator account independency | Administrator accounts are independent of user account. They cannot create or participate in projects. |
| Br03 | Unique email | The same person cannot create two accounts with the same email. |
| Br04 | Unique nickname | Two users cannot have the same nickname. |
| Br05 | Coordinator account deletion | The coordinator cannot delete his account if he is managing a team. He has to assign that job to someone else in the team before doing so. |

Table 8: Business rules

#### 3.2. Technical requirements

| Identifier | Name | Description |
|------------|------|-------------|
| TR01 | Availability | The system must be available praticaly 24 hours a day. |
| TR02 | Accessibility | The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the web browser they use. |
| TR03 | Usability | The system should be simple because it's a platform for everyone, so it has to be easy to use. |
| TR04 | Performance | The system should have a short response time to ensure the user's attention. |
| TR05 | Web application | The system should be implemented as a web application with dynamic pages (HTML5, JavaScript, CSS3 and PHP). |
| **TR06** | **Portability** | **The server-side system should work across multiple platforms (Linux, Mac OS, etc.) so that everyone can access it, no matter the operating system in question.** |
| TR07 | Database | The PostgreSQL database management system must be used, with a version of 11 or higher. |
| **TR08** | **Security** | **The system shall protect information from unauthorised access through the use of an authentication and verification system. It is important to ensure that third parties do not have access to projects carried out on our platform, or to impersonate us.** |
| TR09 | Robustness | The system must be prepared to handle and continue operating when runtime errors occur. |
| **TR10** | **Scalability** | **The system must be prepared to deal with the growth in the number of users and their actions.It is important that with the growth in the number of users, our web application guarantees a fast and quality service to our customers.** |
| TR11 | Ethics | The system must respect the ethical principles in software development (for example, personal user details, or usage data, should not be collected nor shared without full acknowledgement and authorization from its owner). |

Table 9: Technical requirements

#### 3.3. Restrictions

| Identifier | Name | Description |
|------------|------|-------------|
| C01 | Deadline | The system should be ready to be used at the end of the semester. |
| C02 | Price | The web app has a total budget of 0 euros . |

Table 10: Restrictions

## A3: Information Architecture

WorkFluido is a platform for every type of people to develop different projects and keep track of the evolution of each one of them. To this end, the following sections present a brief overview of the information architecture of our project and provide detailed information of the project, featuring the sitemap and a wireframe of the main pages of the website.

### 1. Sitemap

A sitemap is a file that provides information about the pages of the website and the relationships between them.

![sitemap](uploads/5e7325912691bac8cb15eea4934adee0/sitemap.png)

_Figure 2_: Sitemap

### 2. Wireframes

![LBAW_A3main__1\_](uploads/e7567bc9cc9655e56f72bdb7f6b97763/LBAW_A3main__1\_.png)

_Figure 3_: Main page wireframe

1. Access to faq, about and contacts
2. Access to login

![LBAW_A3channel__1\_](uploads/40ab6ebe090ddb1c4d1d63a0addb4020/LBAW_A3channel__1\_.png)

_Figure 4_: Project page wireframe

1. Search feature
2. Favourite a project
3. Access to other projects
4. Access to task details and comments
5. Access to team members
6. Access to notifications

![LBAW_A3login__1\_](uploads/95c9727cfea41e6aa12402102179d5fa/LBAW_A3login__1\_.png)

_Figure 5_: login page wireframe

1. Access to login
2. Access to register

![LBAW_A3profile__1\_](uploads/57ef0d0b196674ae8a45a0a5c54862a3/LBAW_A3profile__1\_.png)

_Figure 6_: profile page wireframe

1. See/Edit profile
2. View projects

---

## Revision history

Changes made to the first submission:

---

GROUP2281, 03/10/2022

* Hugo Gomes up202004343@fe.up.pt
* João Moreira up202005035@fe.up.pt
* João Araújo up202007855@fe.up.pt
* Lia Vieira up202005042@fe.up.pt