# Test Gaspari
test developer

## § Intro

This repository contains a simple dockerized laravel project used as a test.
The project consist of CRUD API's that rappresent a Person Model and its basic basic info and a frontend with Vuejs components to interact with the data 


## § Setting up the project

1. ### Install docker
    If you don't have docker already installed the easier and fastest way to do so is with [docker desktop](https://www.docker.com/products/docker-desktop/) 

2. ### Build project

    1. Build the docker containers using:

        `` docker-compose -f docker-compose.yml up --build -d ``<br/> <br/>

    2. Enter the shell by running <br/>
    `docker exec -it test_app bash` <br/>
    then run the following commands:
        - `composer install` 
        - `php artisan migrate --seed`
        <!-- end of the list -->

    3. Exit the shell with `ctrl+D' then run:
        - ` docker-compose --file .\docker-compose.yml run --rm nodejs npm install`
        - ` docker-compose --file .\docker-compose.yml run --rm nodejs npm run dev`

    4. Confirm the project was correctly built by accessing [http://localhost:8083](http://localhost:8083) on your browser. <br/>
    You should the "Lista persone" view on your screen.
        You can also access phpmyadmin to view the DB at [http://localhost:8084](http://localhost:8084)



