# ToDoList

## How to install application locally
1.  Clone or download the project
```
cd TodoList/
git clone https://github.com/xwyk/todoco.git
```
2.  Copy .env file to .env.local file with your credentials for database access
3.  Use Composer to install all needed dependencies
```
composer install
```
4.  Create the database, the tables and add the data with DataFixtures
```
composer initProject
```
5.  Launch the server
```
symfony server:start
```
This application has been developped with :

*  Symfony 5.3
*  WampServer - Version 3.2.0 - 64bit
*  PhpStorm - 2021.1.1


