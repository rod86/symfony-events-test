Symfony Events
=============

## Setup

- Install Vagrant and Virtualbox.
- Install the vagrant box [Ubuntu 16.04 LEMP box](https://github.com/rod86/ubuntu-lemp-box)
- Connect via SSH into the vagrant box and run

```
$ sudo bin/generatehost.sh -h dev.sf-events.com -t symfony
```

- Add the below line in the hosts file of your host machine

```
    192.168.56.105  dev.sf-events.com
```

- Clone this repository inside the *www* folder

```
    $ cd ubuntu-lemp-box/www
    $ git clone https://github.com/rod86/sf-events
```

- Setup the *app/config/parameters.yml* file.

- Connect via SSH to the box and run

```
   $ cd /var/www/dev.sf-events.com

   # Install composer dependencies
   $ composer install

   # Create database
   $ php bin/console doctrine:database:create

   # Create Tables
   $ php bin/console doctrine:schema:update --force

   # Load test data
   $ php bin/console doctrine:fixtures:load -n
```

## API

### Get all events

```
GET     /api/events
```

It returns an array that contains all the events


### Get event by id

```
GET     /api/events/{id}
```
**Parameters**

- **id**: Event id

It returns the event with all details (place, type and posts)


### Create event

```
POST     /api/events
```
**Parameters**

- **id**: Event id
- **date_start**: start date of the event
- **date_end**: end date of the event
- **description**: event description
- **place_id**: id of a place 
- **type_id**: id of an event type

It returns the created event


### Get all

```
GET     /api/all
```

It returns an array that contains events, posts and places grouped by type


## Problems

Problems I came across

* I am used to symfony 3.2 so I didn't expect major changes in symfony 3.4 like the container.

* I couldn't setup a docker environment and I ended using a vagrant box.

* I don't know how events are related to places and types in the specs, so I supposed that's a many to one association to these 2 tables.

## Improvements

* API error listener: Setup an error exception listener to convert the error data if the request was an api call.

* separate the api actions and logic from the web application in a separate bundle.

* Move some controller logic to services.

* Improve services architecture.

* write tests for controllers and services.