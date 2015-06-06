# Attendance
Simple Attendace Application Build with Laravel Framework V.4.2. Attendance detect device and browser for user verification.
#Installation
Installation Requirement :
  - PHP 5 Above, set environtment variabel for PHP : 
  	- Start->Control Panel\System and Security\System->advanced system settings.
  	- Then click->environment variables.
  	- Search "Path" on the System Variables -> Edit
  	- After that, on the variable value, add the ";"
  	- And Then, copy->Paste the address version php (example:"C:\xampp\php")
  	- click "ok" to Finish
  - Mysql
Installation Steps :
  - Create database in your mysql with dataase name, user and password : **ams**
  - Download and extract the code, open terminal or command prompt go to your Attendance Apps directory.
  - Download composer, install, migrate and run, with command : 
```sh
$ php -r "readfile('https://getcomposer.org/installer');" | php
$ php composer.phar install
$ php artisan migrate
$ php artisan serve
```
  - Open your browser and enter the address http://localhost:8000 or http://127.0.0.1:8000
  
License
----

gnu affero general public license v3 