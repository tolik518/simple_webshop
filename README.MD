# Simple Webshop

This is an approach for a small Webshop with configurable products.   
It was written solely for learning purposes and is not inteded for productive use since the test coverage is not 100% and the tests are not high quality.

To get the shop running you'd have to import all the tables proided in the [database folder](https://github.com/tolik518/simple_webshop/tree/master/Documentation/exported_database) by hand.

---

## 🎥 Technologies Used  
>[Slim-Framework 4.9](https://www.slimframework.com/)  
[PHP 8.0](https://www.php.net/)  
[TypeScript 4.5.5](https://www.typescriptlang.org/)  
[MySQL 8.0](https://www.mysql.com/)  
[Docker](https://www.docker.com/get-started)  
[Composer](https://getcomposer.org/)


## 📊 Admin Dashboard Access   
> 👤 Username: mod  
> 🔑 Password: mod
 
## 👨‍💻 Start Developement

1. Clone repository `git clone https://github.com/tolik518/simple_webshop.git`
2. Build images with `make build` or with `docker compose build`
3. Use `make run` or `docker-compose up -d` to start the containers
4. To install the dependencies and to update the autoloader (do this everyime you add a new class)
  `make install` or `docker compose run --rm --no-deps php_cli php -d memory_limit=-1 /usr/local/bin/composer install`
5. Use `make stop` or `docker-compose down --remove-orphans` to stop the containers



---
## 🎞️ Screenshots

![](https://returnnull.de/images/webshop3.png)
![](https://returnnull.de/images/webshop4.png)
![](https://returnnull.de/images/webshop2.png)
![](https://returnnull.de/images/webshop1.png)