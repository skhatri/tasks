
todo list app with php (no frameworks) and bootstrap



setup database:

1. create a database 'todo'

  create database todo;

2. create a user 'dev'

  create user 'dev'@'localhost' identified by 'dev';

3. grant all privileges on todo to dev

  grant all on todo.* to 'dev'@'localhost';

4. create tasks table on todo
  use todo;
  create table tasks (name varchar(100));

