### To add new Data Provider ex: "DataProviderZ"
- create new `UserAdapterZ.php` class inside `App\Services' namespace
- in `App\Http\Controllers\Api\V1\UserController.php` in addData method you have to add this line of code `$this->addUserData->execute('DataProviderZ.json', 'UserAdapterY');` passing file name as the first parameter

### To read data from json and add it to local db
- just run this url `http://127.0.0.1:8000/api/v1/add-users-data`

### To access data and filter it
- use this url `http://127.0.0.1:8000/api/v1/users`

### To run unit tests
- run this command `./vendor/bin/phpunit`
