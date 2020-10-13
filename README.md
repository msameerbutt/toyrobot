# Toy Robot App

## Dependencies
1. PHP 7.4
1. nginx:1.17
1. Laravel 7.x

## Core Logic Folder
/src/app/Services/Toy

## Application Steps from root directory
1. docker-compose build
1. docker-compose up -d
1. docker-compose exec app bash
1. install composer dependencies `composer --ignore-platform-reqs`
1. clear caches `php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan route:clear`
1. build config cache `php artisan config:cache`
1. browse http://0.0.0.0:8080/
1. Execute ToyRobot Commands

## Automation Testing Steps
1. docker-compose up -d
1. docker-compose exec app bash
1. `php ./vendor/bin/codecept run unit "Services/ToyRobotServiceTest"`

## Test Cases
##### SCENARIO: ACCEPTANCE OUTPUT: 3,3,NORTH
```
PLACE 1,2,EAST,
MOVE,
MOVE,
LEFT,
MOVE,
REPORT
```
##### SCENARIO: ACCEPTANCE OUTPUT: 0,1,NORTH
```
PLACE 0,0,NORTH,
MOVE,
REPORT
```
##### SCENARIO: IGNORE COMMAND BEFORE A FIRST VALID PLACE COMMAND ACCEPTANCE OUTPUT: 0,1,NORTH
```
MOVE,
MOVE,
LEFT,
PLACE 0,0,NORTH,
LEFT,
REPORT
```

##### SCENARIO: IGNORE COMMAND UNTIL A FIRST VALID PLACE COMMAND ACCEPTANCE OUTPUT: 0,0,NORTH
```
MOVE,
MOVE,
LEFT,
PLACE 4,6,SOUTH,
LEFT,
MOVE,
MOVE,
PLACE 0,0,NORTH,
LEFT,
RIGHT,
REPORT
```

##### SCENARIO: ACCEPTANCE OUTPUT: 0,0,SOUTH
```
PLACE 0,0,SOUTH,
MOVE,
REPORT
```