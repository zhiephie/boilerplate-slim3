# Boilerplate for Slim Framework 3 [![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=purwantoyudi42%40gmail%2ecom&lc=ZA&item_name=Timex%20Studio&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted)
  Boilerplate for getting started with Slim Framework
  
  Use this skeleton application to quickly setup and start working on a new Slim Framework 3 application. This application uses the latest Slim 3.
  
###Requirements:
- PHP 5.5 or newer
- PDO PHP Extension
	
###Features


- PHP View
- Twig Template Engine
- Eloquent Laravel
- Sentinel Authentication provider
- Include SDK Facebook
- Logger Monolog
- AdminLTE soon


#####1 Manual Install
You can manually install by cloning this repo or download the zip file from this repo, and run ```composer install```.
```
$ git clone https://github.com/zhiephie/boilerplate-slim3.git
$ composer install
```

#####2 Alternative install via ```composer```
```
$ composer create-project --no-interaction --stability=dev zhiephie/boilerplate-slim3 [folder-name]
```

#####3 Setup Permission
After composer finished install the dependencies, you need to change file and folder permission.
```
$ chmod -R 777 storage
$ chmod 666 config/database.php
```

#####4 Configuration Database and Setting App
Configuration file located in ```config```, edit the database.php, setting.php

#####5 Run ```php migrate```
```
$ php migrate
```

#####6 Run Server  ```php -S localhost:8000 -t public```
```
$ php -S localhost:8000 -t public
```

###That's it! Now go build something cool.
