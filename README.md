# ToDoList

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/2cd9ff9e81c1410ab89d6b59f634217c)](https://app.codacy.com/gh/Xwyk/todoco?utm_source=github.com&utm_medium=referral&utm_content=Xwyk/todoco&utm_campaign=Badge_Grade_Settings)

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


