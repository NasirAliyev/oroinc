# Installation guide for API

Firstly, you need install on local machine these soft :

##### 1. git bash
* Git: https://git-scm.com/downloads

##### 2. docker
* Win/Mac: https://www.docker.com/products/docker-desktop
* Linux: https://docs.docker.com/install/linux/docker-ce/ubuntu/

##### 3. docker-compose
* installation : https://docs.docker.com/compose/install/

## After installing all soft you can start.

**Clone files from giving repository.**

**Create new `.env` file from `env.example` and configure your settings**
_(You also can use default settings.)_

```
 API_PORT - will be used for URL. For default it can be reached http://localhost if you use 80 port. Otherwise you can set any port and open API by the URL : http://localhost:<api-port> 
 DB_HOST - Your DB container name from docker-compose.yml
 DB_DATABASE - Database name, will be created automatically.
 DB_USER - Database user. Once it is only test we can use root. KIS - keep it simple :))
 DB_PASSWORD - Database password.
 DB_PORT - Database port which will be reached inside the containers.
 DB_EXTERNAL_PORT - Database port which you can reach outside of containers. For example for any DB client soft like Mysql WorkBench.
```

**Open CMD/Terminal and run:** 
```
docker-compose build
``` 
_Note : First time it will take more time, you should not run it every time before starting work._ 

**Then run following command:** 
```
docker-compose up -d
```

**Check all containers by the command:** 
```
docker-compose ps
```

If every thing is okay you should see all containers status *Up* :
```
     Name                    Command               State                 Ports               
---------------------------------------------------------------------------------------------
oroinc_new_main_1    docker-php-entrypoint php-fpm    Up      9000/tcp                                             
oroinc_new_mysql_1   docker-entrypoint.sh --def ...   Up      0.0.0.0:33066->3306/tcp,:::33066->3306/tcp, 33060/tcp
oroinc_new_nginx_1   /docker-entrypoint.sh ngin ...   Up      0.0.0.0:88->80/tcp,:::88->80/tcp     
```

**Now you should run installation dependencies from main container:**
```
docker-compose exec main composer install
```

**Once we installed all packages we have to run migrations:**
```
docker-compose exec main bin/console doctrine:migrate:migrate
```

### We have finished installation )

Now you can open the API from this link : http://localhost:88

## Code style checking:
```
docker-compose exec main vendor/squizlabs/php_codesniffer/bin/phpcs
```

## Tests

Run all tests from command :
```
docker-compose exec main ./bin/phpunit 
```
You will get result like this:

```
Testing 
...........        11 / 11 (100%)

Time: 00:00.549, Memory: 20.00 MB


```

Also You can run Unit and Functional tests separately:
```
docker-compose exec main ./bin/phpunit tests/Unit
```

```
docker-compose exec main ./bin/phpunit tests/Funtional
```

## Additional 

**Soft and tools :** 
```
 PHP version - 8
 Symfony version - 5.*
 Mysql - 5.7 
 PHPcs - latest version with rules PSR-12 Coding Style
 PHPUnit - 9.5
```