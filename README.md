
# Single-Click Dockerized Todo App with Nginx, Laravel, Vue (SPA), PostgreSql

![Docker whale with full-stack ](https://github.com/ymgsmz/full-stack-dockerized-todo-app/raw/master/cover.jpg)

A ready to use application included Php (for backend), JavaScript (NodeJs based frontend) and PostgreSQL database.
It is possible to running these applications just by clone this repository and executing several commands for initializing Laravel framework.

## USEFUL FOR

- Since this project is produced and containerized via Docker-Compose, could be useful for those full-stack developers who would have a start learning point to awesome Docker.
- It may also be used for running a full-stack application in local or staging environments.
- Although do not recommend running apps containerized by Docker Compose in production environments but you can use this project for cases you are going to run the application in one server. (DON'T FORGET SECURITY PREREQUISITES)

## PREREQUISITES
Follow up the official docs of Docker to install `Docker Engine` and `docker-compose`:
[https://docs.docker.com/compose/install/](https://docs.docker.com/compose/install/ "Docker")

## RUNNING STEPS
1. You need to clone master branch where you wanna use it, via ssh:
	```bash
	$ git clone git@github.com:ymgsmz/full-stack-dockerized-todo-app.git
	```
	or REST:
	```bash
	$ git clone https://github.com/ymgsmz/full-stack-dockerized-todo-app.git
	``` 
	then switch to directory:
	```bash
	$ cd ./full-stack-dockerized-todo-app
	```
	- If you going to access the app by a domain you need to change the backend API URL in the frontend application by this way:
		```bash
		$ [your-editor (vi OR nano)] ./app/todo-front/src/vars.js
		```
		then replace your domain instead of `localhost`.
		
2. Now the time is to build the containers by running command below:
	```bash
	$ docker-compose build
	```
	- the process may takes time depending on your internet connection speed.
	- using `--no-cache` flag caused to ignore cache of previous build and recommended when you had change in the app's files and dependencies.
	
3. After building process done, we going to make up our containers by this command:
	```bash
	$ docker-compose up -d
	```
	- you can merge step 2 and 3 by executing shorter command as below:
		```bash
		$ docker-compose up -d --build
		```
	- `-d` flag means **d**etach and used when you want to make the terminal free right after process done to running further commands.

Congrats you are running a full-stack application in simplest way.
**Note that** to executing any command belongs and across the applications you have to `ssh` to the respective container by command below:
```bash
$ docker-compose exec [your-container-name] sh
```

#### From here onward the steps belongs to initializing applications:
### Laravel
-----------------
1. We have to generate a key for our Laravel application, this is once  unless you remove the volumes related to backend container, so we need to ssh to container `backend` by the noted formula in the above section and run `artisan` command:
	```bash
	$ php artisan key:generate
	```
2. Migrations are the second step that every Laravel based application needs for first initializing:
	```bash
	$ php artisan migrate
	```
	- Remember that the database data directory has not mounted to the local directory so we will lose our data after make down the database container called `postgre`.
	- To avoid any data losing, google about `docker mount postgresql data directory`.

The common configurations has been finished and now you can access the app by `localhost` from local or your domain *(if adjusted)* from anywhere.

## CONTRIBUTION
I'm happy for sharing my knowledge in the format of a free source repository, we should push each other forward to motivate to share our knowledge with the open-source community.

Feel free to create issued and ask your questions or help the community by your pull requests.

## REFERENCES
- [Docker Engine](https://www.docker.com/ "docker") - Cool containerizer and orchestrator
- [Nginx](https://nginx.com/ "Nginx") - Web server and reverse proxy 
- [Laravel](https://laravel.com/ "Laravel") - Php awesome framework
- [VueJs](https://vuejs.org/ "Vue") - NodeJs-based framework (love it)
- [PostgreSQL](https://www.postgresql.org/ "Postgre") - Prefer rather than My one
