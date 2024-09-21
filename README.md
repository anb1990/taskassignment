## Laravel
Version: 11.23.5

##.env 
Yoy can copy .env.example content, i put original .env content in it.

##Design Patterns
1-Repositry to abstract data layer (created for project and task)
2-Service layer fo handeling buisness logic (created for project and task)
3-Singelton: for creating one instance of log service (Additional Design Patterns)

#webControllers
For handleing all web requests and login will be applied by apiControllers

#apiControllers
will handle api's after authintication

#apiAuthintication
Passport used for authToken creations

#Permissions
Two permissions created User & Admin and are handeled using Policy

#UnitTest
Simple one created for tedting ProjectApiController, didn't get time to complete it to test requests with authToken or creating other tests.
Test environment handeled to connect test database

#fetch api
Used for add,edit,delete projects and tasks

#database relations
A one-to-many relationship between Projects and Tasks.

#Dockerization
Added files for Dockerization but didn't get time to compile it.

#How it works
Once project is running, you will start with default route which is login, for first time switch to register page, you can create there user with a type of user or admin.
Register page will not redirect you anywhere after success for easily creating users.

