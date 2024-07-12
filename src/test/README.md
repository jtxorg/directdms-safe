# Test Suite for DirectRM

## Katalon Testing

DirectRM can be tested using the Katalon Recorder or other compatible apps.

### How-To Test

* Install the Katalon Recorder plugin for Chrome
* Copy the resources/test.txt file to /var/www/test.txt  on your mac or linux computer 
* Start a local docker-compose deployment:
  `docker-compose up -d --build`
* Load a test suite and choose a suite from the /tests folder in the DirectRM codebase
* Play the test suite in Katalon
* To clean up for another thest run this:
` docker-compose stop; docker-compose rm -f; docker volume rm DirectRM_odm-db-data DirectRM_odm-files-data DirectRM_odm-docker-configs; docker-compose up -d --build`