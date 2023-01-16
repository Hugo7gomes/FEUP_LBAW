# EAP: Architecture Specification and Prototype

## A7: Web Resources Specification

The architecture of the web application to develop is documented indicating the catalogue of resources and the properties of each resource, including: references to the graphical interfaces, and the format of JSON responses. This page includes the following operations over data: create, read, update, and delete.

### 1. Overview

<table>
<tr>
<td>M01: Authentication and Individual Profile</td>
<td>Web resources associated with user authentication and individual profile management. Includes the following system features: login/logout, registration, view and edit personal profile information, list user's projects.</td>
</tr>
<tr>
<td>M02: Project Management</td>
<td>Web resources associated with project management. Searching for projects. Create, edit and delete projects. Notifications related to the project. Adding new members to the team and adding a project to user favorites.</td>
</tr>
<tr>
<td>M03: Task Management</td>
<td>Web resources associated with task management, specifically: view and edit task details, comment and assing a task to other team member.</td>
</tr>
<tr>
<td>M04: User Administration and Static pages</td>
<td>Web resources associated with user management, specifically: view and search users, delete or block user accounts, view user information. Web resources with static content are associated with this module: about, contact, and faq.</td>
</tr>
</table>

### 2. Permissions

<table>
<tr>
<td>PUB</td>
<td>Public</td>
<td>Users without privileges</td>
</tr>
<tr>
<td>USR</td>
<td>User</td>
<td>Authenticated users except Administrator</td>
</tr>
<tr>
<td>CRD</td>
<td>Coordinator</td>
<td>User that manages a team</td>
</tr>
<tr>
<td>CLB</td>
<td>Collaborator</td>
<td>User that belongs to a team with no coordinator privileges</td>
</tr>
<tr>
<td>ADM</td>
<td>Administrator</td>
<td>System administrators</td>
</tr>
</table>

### 3. OpenAPI Specification

OpenAPI specification in YAML format to describe the web application's web resources.

[Open API Specification File](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2281/-/blob/main/a7_openapi.yaml)

```yaml

openapi: 3.0.0

info:
  version: '1.0'
  title: 'LBAW Workfluido Web API'
  description: 'Web Resources Specification (A7) for Workfluido'

servers:
- url: http://lbaw2281.lbaw.fe.up.pt
  description: Production server

externalDocs:
  description: Find more info here.
  url: https://git.fe.up.pt/lbaw/lbaw2223/lbaw2281/-/wikis/eap

tags:
  - name: 'M01: Authentication and Individual Profile'
  - name: 'M02: Project Management'
  - name: 'M03: Task Management'
  - name: 'M04: User Administration and Static pages'

paths:
  /login:
    get:
      operationId: R101
      summary: 'R101: Login Form'
      description: 'Provide login form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '200':
          description: 'Ok. Show Log-in UI'
        '302':
          description: 'Redirect if user is logged in.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Authenticated. Redirect to homePage.'
                  value: '/'


    post:
      operationId: R102
      summary: 'R102: Login Action'
      description: 'Processes the login form submission. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:         # <!--- form field name
                  type: string
                password:      # <!--- form field name
                  type: string
              required:
                  - email
                  - password

      responses:
        '302':
          description: 'Redirect after processing the login credentials.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful authentication. Redirect to homePage.'
                  value: '/'
                302Error:
                  description: 'Failed authentication. Redirect to login form.'
                  value: '/login'

  /logout:
    get:
      operationId: R103
      summary: 'R103: Logout Action'
      description: 'Logout the current authenticated user. Access: USR ADM'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '302':
          description: 'Redirect after processing logout.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful logout. Redirect to home page.'
                  value: '/'

  /register:
    get:
      operationId: R104
      summary: 'R104: Register Form'
      description: 'Provide new user registration form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '200':
          description: 'Ok. Show register UI'
        '302':
          description: 'Redirect if user is logged in.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Authenticated. Redirect to home page.'
                  value: '/'

    post:
      operationId: R105
      summary: 'R105: Register Action'
      description: 'Processes the new user registration form submission. Access: USR'
      tags:
        - 'M01: Authentication and Individual Profile'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                username:
                  type: string
                email:
                  type: string
                password:
                  type: string
                photo:
                  type: string
                  format: byte
              required:
                - name
                - email
                - password
                - username

      responses:
        '302':
          description: 'Redirect after processing the new user information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful authentication. Redirect to home page.'
                  value: '/'
                302Failure:
                  description: 'Failed authentication. Redirect to register form.'
                  value: '/register'

  /forgot-password:
    get:
      operationId: R106
      summary: 'R106: Forgot Password Form'
      description: 'Provide new user registration form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '200':
          description: 'Ok. Show register UI'
        '302':
          description: 'Redirect if user is logged in.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Authenticated. Redirect to home page.'
                  value: '/'
    
    post:
      operationId: R107
      summary: 'R107: Forgot password Action'
      description: 'An email is sent to the user in order to recover the password. Access: USR'
      tags:
        - 'M01: Authentication and Individual Profile'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:
                  type: string
              required:
                - email

      responses:
        '302':
          description: 'Redirect after processing the new user information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful email sent.'
                  value: '/'
                302Failure:
                  description: 'Invalid email. Redirect to register form.'
                  value: '/register'
    
    
  /reset-password:  
    get:
      operationId: R108
      summary: 'R108: UI after validating the email that was sent'
      description: 'Provide new user registration form. Access: PUB'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '200':
          description: 'Ok. Show reset-password UI'
        '302':
          description: 'Redirect if user is logged in.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Authenticated. Redirect to home page.'
                  value: '/'
    post:
      operationId: R109
      summary: 'R109: Reset password Action'
      description: 'Reseting the new password. Access: USR'
      tags:
        - 'M01: Authentication and Individual Profile'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:
                  type: string
                password:
                  type: string
                token:
                  type: string
              required:
                - email
                - password
                - token

      responses:
        '302':
          description: 'Redirect after processing the reset information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Login sucessful.'
                  value: '/'
                302Failure:
                  description: 'Invalid credentials. Redirect to register form.'
                  value: '/register'

  /profile:
    get:
      operationId: R110
      summary: 'R110: View Personal Profile'
      description: 'Show the individual user profile. Access: USR ADM'
      tags:
        - 'M01: Authentication and Individual Profile'
      responses:
        '200':
          description: 'Ok. Show User Profile UI'
        '302':
          description: 'Redirect if user is not logged in.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Error:
                  description: 'Not Authenticated. Redirect to login form.'
                  value: '/login'

    patch:  # <!--- Editar perfil update parts of the resource
      operationId: R111
      summary: 'R111: Edit Profile'
      description: 'Edit account information. Access: USR ADM'
      tags:
        - 'M01: Authentication and Individual Profile'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                email:
                  type: string
                username:
                  type: string
                password:
                  type: string
                name:
                  type: string
                photo:
                  type: string
                  format: byte
      responses:
        '200':
          description: 'Ok'
        "401":
          description: "Unauthorized"
        
    delete:
      operationId: R112
      summary: 'R112: Delete Account'
      description: 'Delete account. Access: USR'
      tags:
        - 'M01: Authentication and Individual Profile'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                user_id:
                  type: integer
              required:
                - user_id
      responses:
        '200':
          description: 'Ok'
        "401":
          description: "Unauthorized"   # <!--- Caso do coordenador

  /profile/{username}:
    get:
      operationId: R113
      summary: 'R113: View User Profile'
      description: 'Show user profile. Access: USR'
      tags:
        - 'M01: Authentication and Individual Profile'

      parameters:
        - in: path
          name: username
          schema:
            type: string
          required: true

      responses:
        '200':
          description: 'Ok. Show UI User Profile'
        '404':
          description: 'Not Found. Show UI User Not Found'

  /profile/avatar:
    post:
      operationId: R114
      summary: 'R114: Upload a picture'
      description: 'Aploading a avatar picture. Access: USR'
      tags:
        - 'M01: Authentication and Individual Profile'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                avatar:
                  type: string
                  format: byte
              required:
                - avatar

      responses:
        '302':
          description: 'Redirect after processing the avatar upload.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Upload sucessfull.'
                  value: '/profile'
                302Failure:
                  description: 'Invalid file. Redirect to profile.'
                  value: '/profile'


  /project/create:
    get:
      operationId: R201
      summary: 'R201: Create Project Form'
      description: 'Provide new project form. Access: USR'
      tags:
        - 'M02: Project Management'
      responses:
        '200':
          description: 'Ok. Show Project create form UI'
        '302':
          description: 'Redirect if user is not logged in.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Error:
                  description: 'Not Authenticated. Redirect to login page.'
                  value: '/login'

    post:
      operationId: R202
      summary: 'R202: Create Project Action'
      description: 'Processes the project creation form submission. Access: USR'
      tags:
        - 'M02: Project Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                description:
                  type: string
              required:
                - name
                - description

      responses:
        '302':
          description: 'Redirect after processing the new project information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful creation. Redirect to homePage'
                  value: '/'
                302Failure:
                  description: 'Failed creation. Redirect to homePage'
                  value: '/'

  /project/{project_id}:
    get:
      operationId: R203
      summary: 'R203: Get Project Information'
      description: "Get project information. Access: CLB ADM"
      tags:
        - 'M02: Project Management'

      parameters:
        - in: path
          name: project_id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: Success
        "403":
          description: Forbidden
        "404":
          description: Not Found
  
  /project/{project_id}/members:
    get:
      operationId: R204
      summary: 'R204: See Project Team member Information'
      description: "See project team  members. Access: CLB ADM"
      tags:
        - 'M02: Project Management'

      parameters:
        - in: path
          name: project_id
          schema:
            type: integer
          required: true

      responses:
        '200':
          description: Success
        "403":
          description: Forbidden
        "404":
          description: Not Found

  
  /project/{project_id}/edit:
    get:
      operationId: R205
      summary: 'R205: Show Edit Project Information'
      description: " Show edit project information. Access: CRD"
      tags:
        - 'M02: Project Management'

      parameters:
        - in: path
          name: project_id
          schema:
            type: integer
          required: true
          
      responses:
        '200':
          description: 'Ok. Show Project Edit UI'
        '302':
          description: 'Redirect if user not logged in.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Error:
                  description: 'Not Authenticated. Redirect to home page.'
                  value: '/'
        '403':
          description: 'Forbidden, user dont have that privileges'
      
    patch:  
      operationId: R206
      summary: 'R206: Edit Project Details'
      description: 'Edit project information. Access: CRD'
      tags:
        - 'M02: Project Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                project_id:
                  type: integer
                name:
                  type: string
                details:
                  type: string
      responses:
        '200':
          description: 'Ok'
        "401":
          description: 'Unauthorized'
    
  /project/{project_id}/leave:
    delete:
      operationId: R207
      summary: 'R207: Leave Project'
      description: 'Leave a project. Access: CLB'
      tags:
        - 'M02: Project Management'
      
      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                project_id:
                  type: integer
                user_id:
                  type: integer
  
      responses:
        '302':
          description: 'Redirect after processing the leave request.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful. Redirect to homePage.'
                  value: '/'
                302Failure:
                  description: 'Failed. Redirect to the project.'
                  value: '/project'
        "403":
          description: 'Forbidden'
  
  /project/{project_id}/archive:
    patch:
      operationId: R208
      summary: 'R208: Archive a Project'
      description: 'Arquivar um projeto. Access: CRD ADM'
      tags:
        - 'M02: Project Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                project_id:
                  type: integer
      responses:
        '200':
          description: 'Ok'
        "401":
          description: 'Unauthorized'
      

  /api/project/{project_id}/inviteMember:
    post:
      operationId: R209
      summary: 'R209: Invite Member'
      description: 'Processes new user invite. Access: CRD'
      tags:
        - 'M02: Project Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id_project:
                  type: integer
                id_user:
                  type: integer
              required:
                - id_project
                - id_user

      responses:
        '302':
          description: 'Redirect after processing the new invite to the project.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful request. Redirect to project.'
                  value: '/project'
                302Failure:
                  description: 'Failed request. Redirect to project.'
                  value: '/project'
  
  /project/acceptInvite:
    post:
      operationId: R210
      summary: '210: Accept Project Invite'
      description: 'Accept project invite. Access: USR'
      tags:
        - 'M02: Project Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                user_id:
                  type: integer
                project_id:
                  type: integer

      responses:
        '200':
          description: 'Ok'

  /project/rejectInvite:
    delete:
      operationId: R211
      summary: '211: Reject Project Invite'
      description: 'Reject project invite. Access: ACO'
      tags:
        - 'M02: Project Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                user_id:
                  type: integer
                project_id:
                  type: integer
      responses:
        '200':
          description: 'Ok'
  
  /api/notification/delete:
    delete:
      operationId: R212
      summary: '212: Delete Notification'
      description: 'Delete notification. Access: USR'
      tags:
        - 'M02: Project Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                id_notification:
                  type: integer
      responses:
        '200':
          description: 'Ok'


  /api/project/{project_id}/favorite/create:
    post:
      operationId: R213
      summary: 'R213: Favourite Project'
      description: 'Add project to favourites. Access: USR'
      tags:
        - 'M02: Project Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                project_id:
                  type: integer
                user_id:
                  type: integer
              required:
                - project_id
                - user_id

      responses:
        '302':
          description: 'Redirect after processing the new favorite project information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful favorite. Redirect to project page'
                  value: '/project'
                302Failure:
                  description: 'Failed creation. Redirect to project page'
                  value: '/project'

  /api/project/{project_id}/favorite/delete:
    delete:
      operationId: R214
      summary: 'R214: Remove Favourite Project'
      description: 'Delete project from favourites. Access: USR'
      tags:
        - 'M02: Project Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                project_id:
                  type: integer
                user_id:
                  type: integer
              required:
                - project_id
                - user_id

      responses:
        '302':
          description: 'Redirect after processing the new desfavorite project information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful desfavorite. Redirect to project page'
                  value: '/project'
                302Failure:
                  description: 'Failed desfavorite. Redirect to project page'
                  value: '/project'
  
  /api/search:
    get:
      operationId: R214
      summary: "R214: Search Projects and Tasks API"
      description: "Search for projects, tasks and users and returns the results as JSON. Access: USR"
      tags:
        - 'M02: Project Management'

      parameters:
        - in: query
          name: query
          description: String to use for full-text search
          schema:
            type: string
          required: false

      responses:
        '200':
          description: Success
          content:
            application/json:
              schema:
                type: array
                items:
                  $ref: 
                    -'#/components/schemas/Project' '#/components/schemas/Project'
        '400':
          description: Bad Request

  /api/project/{project_id}/removeMember:
    delete:
      operationId: R215
      summary: 'R215: Remove Member From Project'
      description: 'Remove Member From Project. Access: ADM'
      tags:
        - 'M02: Project Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                project_id:
                  type: integer
                user_id:
                  type: integer
              required:
                - project_id
                - user_id

      responses:
        '302':
          description: 'Redirect after removing a member from the team.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful member remove. Redirect to project page'
                  value: '/project'
                302Failure:
                  description: 'Fail to remove member. Redirect to project page'
                  value: '/project'

  /api/project/{project_id}/upgradeMember:
    patch:
      operationId: R216
      summary: 'R216: Upgrade Member position on Project'
      description: 'Upgrade Member position on Project. Access: CRD'
      tags:
        - 'M02: Project Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                project_id:
                  type: integer
                user_id:
                  type: integer
              required:
                - project_id
                - user_id

      responses:
        '302':
          description: 'Redirect after upgrade member position on team.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful member upgrade status. Redirect to project page'
                  value: '/project'
                302Failure:
                  description: 'Fail to upgrade member status. Redirect to project page'
                  value: '/project'


  /api/project/{project_id}/task/{task_id}:
    get:
      operationId: R301
      summary: 'R301: See Task Info'
      description: 'Provide task info. Access: CLB ADM'
      tags:
        - 'M03: Task Management'
      responses:
        '200':
          description: 'Ok. Show task UI'
        '401':
          description: 'Unauthorized'     

  /task/create:
    post:
      operationId: R302
      summary: 'R302: Create Task'
      description: 'Processes the task creation form submission. Access: CLB '
      tags:
        - 'M03: Task Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                details:
                  type: string
                priority:
                  type: string
                user_assigned:
                  type: integer
              required:
                - name
                - details
                - priority
                - user_assigned

      responses:
        '302':
          description: 'Redirect after processing the new project information.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful creation. Redirect to project.'
                  value: '/project'
                302Failure:
                  description: 'Failed creation. Redirect to project.'
                  value: '/project'

  /task/edit:
    patch:
      operationId: R303
      summary: 'R303: Edit Task Action'
      description: 'Processes the edit task form submission. Access: CLB CRD'
      tags:
        - 'M03: Task Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                name:
                  type: string
                details:
                  type: string
                priority:
                  type: string
                user_assigned:
                  type: integer
              required:
                - name
                - details
                - priority
                - user_assigned

      responses:
        '302':
          description: 'Redirect after edit task.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful editing. Redirect to project page.'
                  value: '/project'
        '401':
          description: 'forbidden'
  
  /task/delete:
   delete:
      operationId: R304
      summary: 'R304: Delete Task'
      description: 'Delete task. Access: CRD ADM'
      tags:
        - 'M03: Task Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                task_id:
                  type: integer

      responses:
        '302':
          description: 'Redirect after processing the delete task request.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful. Redirect to homePage.'
                  value: '/'
        "403":
          description: 'Forbidden'

  /api/project/{project_id}/task/{task_id}/addComment:
    post:
      operationId: R305
      summary: 'R305: Comment Task'
      description: 'Comment a task. Access: CLB'
      tags:
        - 'M03: Task Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                comment:
                  type: string
                id_user:
                  type: integer
                priority:
                  type: string
              required:
                - comment
                - id_user

      responses:
        '302':
          description: 'Redirect after processing the new comment on a task.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful creation. Redirect to homePage'
                  value: '/task'
                302Failure:
                  description: 'Failed creation. Redirect to homePage'
                  value: '/task'
  
  /task/comment/delete:
     delete:
      operationId: R306
      summary: 'R306: Delete Task Comment'
      description: 'Delete a comment on task. Access: CRD ADM'
      tags:
        - 'M03: Task Management'

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                comment_id:
                  type: integer

      responses:
        '302':
          description: 'Redirect after processing the delete comment request.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful. Redirect to homePage.'
                  value: '/'
        "403":
          description: 'Forbidden'


  
  /contact:   
    get:
      operationId: R401
      summary: 'R401: View Contacts Page'
      description: "View contacts page. Access: PUB"
      tags:
        - 'M04: User Administration and Static pages'      
        
      responses:
        '200':
          description: 'OK. Show UI Contacts'

  /faq:   
    get:
      operationId: R402
      summary: 'R402: View Faqs Page'
      description: "View faqs page. Access: PUB"
      tags:
        - 'M04: User Administration and Static pages'      
        
      responses:
        '200':
          description: 'OK. Show UI Faqs'
    
    post:
      operationId: R403
      summary: 'R403: Add a New Faq'
      description: 'Add a new faq. Access: ADM'
      tags:
        - 'M04: User Administration and Static pages' 

      requestBody:
        required: true
        content:
          application/x-www-form-urlencoded:
            schema:
              type: object
              properties:
                question:
                  type: string
                answer:
                  type: string
              required:
                - question
                - answer

      responses:
        '302':
          description: 'Redirect after processing the new comment on a task.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Successful creation. Redirect to homePage'
                  value: '/task'
                302Failure:
                  description: 'Failed creation. Redirect to homePage'
                  value: '/task'

  /about:   
    get:
      operationId: R404
      summary: 'R404: View about Page'
      description: "View about page. Access: PUB"
      tags:
        - 'M04: User Administration and Static pages'      
        
      responses:
        '200':
          description: 'OK. Show UI about '
  
  /:   
    get:
      operationId: R405
      summary: 'R405: Redirect to homePage'
      description: "home page shortcut. Access: PUB"
      tags:
        - 'M04: User Administration and Static pages'      
      responses:
        '302':
          description: 'Redirect to homePage.'
          headers:
            Location:
              schema:
                type: string
              examples:
                302Success:
                  description: 'Authenticated. Redirect to homePage.'
                  value: '/home'

  /home:   
    get:
      operationId: R406
      summary: 'R406: View homePage'
      description: "View home page. Access: PUB"
      tags:
        - 'M04: User Administration and Static pages'      
      responses:
        '200':
          description: 'OK. Show UI about '



components:
  schemas:
    User:
      type: object
      properties:
        id:
          type: integer
        username:
          type: string
        name:
          type: string
        avatar:
          type: string
          format: byte

    Project:
      type: object
      properties:
        id:
          type: integer
        name:
          type: string
        description:
          type: string
        users:
          type: array
          items:
            $ref: '#/components/schemas/User'
    
    Comment:
      type: object
      properties:
        id:
          type: integer
        author:
          $ref: '#/components/schemas/User'
        date:
          type: string
        comment:
          type: string
    
    Task:
      type: object
      properties:
        id:
          type: integer
        name:
          type: string
        details:
          type: string
        state:
          type: string
          enum: ['To Do', 'Doing', 'Done']
        priority:
          type: string
          enum: ['High', 'Medium', 'Low']
        creation_date:
          type: string
        user_creator:
          type: object
          items:
            $ref: '#/components/schemas/User'
        user_assigned:
          type: object
          items:
            $ref: '#/components/schemas/User'
        comments:
          type: array
          items:
            $ref: '#/components/schemas/Comment'


```

---

## A8: Vertical prototype

> The Vertical Prototype includes the implementation of two or more user stories (the simplest) and aims to validate the architecture presented, also serving to gain familiarity with the technologies used in the project.
>
> The implementation is based on the [LBAW Framework](https://git.fe.up.pt/lbaw/template-laravel) and includes work on all layers of the architecture of the solution to implement: user interface, business logic and data access. The prototype implements pages for visualizing, inserting, editing and removing information, as well as functionality for access management and display of error and success messages.

### 1. Implemented Features

#### 1.1. Implemented User Stories

> The following table presents the implemented user stories in the vertical prototype.

| User Story reference | Name | Priority | Description |
|----------------------|------|----------|-------------|
| US01 | Homepage | High | As a User, I want to access the home page, so that I can see a brief presentation of the website. |
| US05 | Sign In | High | As an Anonymous User, I want to authenticate into the system, so that I can access privileged information. |
| US06 | Sign Up | High | As an Anonymous User, I want to register myself into the system, so that I can have my own account. |
| US09 | Edit Profile | High | As an Authenticated User, I want to edit my profile, so that I can update my information. |
| US10 | Create Project | High | As an Authenticated User, I want to be able to create a new project, so that I can lead and organize a new team project. |
| US11 | Log out | High | As an Authenticated User, I want to log out, so that I can close my account. |
| US12 | View Profile | High | As an Authenticated User, I want to view my profile, so that I can verify if all my information is correct. |
| US13 | Accept Team Invitations | High | As an Authenticated User, I want to be able to accept an invitation, so that I can join a team and become a collaborator. |
| US14 | View projects | High | As an Authenticated User, I want to view my projects so that I can access them easily. |
| US15 | View Personal Notifications | High | As an Authenticated User, I want to be able to receive personal notifications, so that I am always updated. |
| US19 | Leave Project | High | As a Collaborator, I want to be able to leave the team, so that I don't belong anymore. |
| US20 | Manage Tasks | High | As a Collaborator, I want to be able to change the tasks details, so that I can manage the priority, labels and due dates of the projects. |
| US21 | Create Task | High | As a Collaborator, I want to be able to create new tasks, so that I can better organize what needs to be done. |
| US22 | View Task Details | High | As a Collaborator, I want to see task details, so that I am informed. |
| US23 | Search Tasks | High | As a Collaborator, I want to search tasks, so that get to the task more easily. |
| US24 | Complete an Assigned Task | High | As a Collaborator, I want to complete an assigned task, so that I can update the project progression status. |
| US28 | Add Users to Project | High | As a Coordinator, I want to add users to the project, so that I can add team members to my project. |
| US29 | Assign New Coordinator | High | As a Coordinator, I want to assign a new coordinator, so that I can have a user to help me or to leave that position. |
| US30 | Edit Project Details | High | As a Coordinator, I want to edit project details, so that the information is updated. |
| US31 | Remove project member | High | As a Coordinator, I want to remove an element from the team, so that former team members no longer have access to the project. |
| US32 | Archive Project | High | As a Coordinator, I want to archive a project, so that my workspace is organized. |

#### 1.2. Implemented Web Resources

> The web resources that were implemented in the prototype are described in the next section.

**Module M01: Authentication and Individual Profile**

| Web Resource Reference | URL |
|------------------------|-----|
| R101: Login Form | POST [/login](http://lbaw2281.lbaw-prod.fe.up.pt/login) |
| R102: Login Action | POST /login |
| R103: Logout Action | POST /logout |
| R104: Register Form | [/register](http://lbaw2281.lbaw-prod.fe.up.pt/register) |
| R105: Register Action | POST /register |
| R106: View personal profile | [/profile](http://lbaw2281.lbaw-prod.fe.up.pt/profile) |
| R107: Edit Profile | PATCH /profile |
| R109: View User Profile | [/profile/{username}](http://lbaw2281.lbaw-prod.fe.up.pt/profile/liavieira02) |

**Module M02: Project Management**

| Web Resource Reference | URL |
|------------------------|-----|
| R201: Create Project Form | [/project/create](http://lbaw2281.lbaw-prod.fe.up.pt/project/create) |
| R202: Create Project Action | POST /project/create |
| R203: View Project | [/project/{project_id}](http://lbaw2281.lbaw-prod.fe.up.pt/project/1) |
| R204: Edit Project Details Form | [/project/edit](http://lbaw2281.lbaw-prod.fe.up.pt/project/edit) |
| R205: Edit Project | PATCH /project/edit |
| R207: Leave Project | DELETE /project/leave |
| R208: Invite Member | POST /project/inviteMember |
| R209: Accept Invite | POST /project/acceptInvite |
| R210: Reject Invite | DELETE /project/rejectInvite |
| R211: Delete Notification | DELETE api/notification/delete |
| R212: Favourite Project | POST api/project/favorite/create |
| R213: Remove Favourite Project | DELETE api/project/favorite/delete |
| R214: Search Projects and Tasks API | [/api/search](http://lbaw2281.lbaw-prod.fe.up.pt/api/search) |
| R215: Remove Member from Project | DELETE api/project/removeMember |
| R216: Upgrade Member Position on Project | PATCH api/project/upgradeMember |

**Module M03: Task Management**

| Web Resource Reference | URL |
|------------------------|-----|
| R301: See Task Info | [/task](http://lbaw2281.lbaw-prod.fe.up.pt/task/edit) |
| R302: Create Task | [/task/create](http://lbaw2281.lbaw-prod.fe.up.pt/task/create) |
| R303: Edit Task Form | [/task/edit](http://lbaw2281.lbaw-prod.fe.up.pt/task/edit) |
| R304: Edit Task Action | PATCH /task/edit |
| R305: Delete Task | DELETE /task/delete |

**Module M04: User Administration and Static pages**

| Web Resource Reference | URL |
|------------------------|-----|
| R405: Redirect to HomePage | [/](http://lbaw2281.lbaw-prod.fe.up.pt/) |
| R406: View HomePage | [/home](http://lbaw2281.lbaw-prod.fe.up.pt/home) |

### 2. Prototype

The prototype is available at [lbaw2281.lbaw-prod.fe.up.pt/](http://lbaw2281.lbaw-prod.fe.up.pt/)

**Credentials:**

Regular user: test123@gmail.com | test123

The code is available at [https://git.fe.up.pt/lbaw/lbaw2223/lbaw2281/-/tree/master](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2281/-/tree/master)


## Revision history

Changes made to the first submission:

1. Changed priority of 'US15:View Personal Notifications' to high.
2. Changed priority of 'US33:Administrate User Accounts' to medium.
3. Changed priority of 'US34:Browse project' to medium.
4. Changed priority of 'US35:View Project Details' to medium.
5. Changed priority of 'US36:Block and Unblock User Accounts' to medium.
6. Changed priority of 'US37:Delete User Accounts' to medium.
7. Changed priority of 'US:Add FAQ' to medium.

GROUP2122, 24/11/2022

* Hugo Gomes up202004343@fe.up.pt
* João Moreira up202005035@fe.up.pt
* João Araújo up202007855@fe.up.pt
* Lia Vieira up202005042@fe.up.pt