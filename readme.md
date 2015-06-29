ads-statistics
==============

<h3>Agility Data Systems Statistics Tracking Module for Laravel</h3>

The module will track the page view history for all users of the associated website. The module will log 500 error statistics to help with debugging code. Additionaly, the posted data for form submission will be saved in the database. The settings file has an array option that allows you to remove sensitive files from being saved in the tracking table.

Once configired, this plugin will automatically save page viewing history to the database.

_(Make sure to run "php artisan migrate" if updating)_

Step 1:

Set up composer, add the package to your require tag:
```
"ads/statistics": "dev-master"

(if using Laravel 4, use "1.*@dev")
```

run
```
php composer update
```

Step 2:

run migration: 
```
php artisan migrate
```

Step 3:

Add alias and service provider to app/config/app.php
```
'Ads\Statistics\StatisticsServiceProvider',
```
and
```
'Statistic'       => 'Ads\Statistics\Statistic',
```

In order to log 500 errors, you'll need to add some code to the app/Exceptions/Handler.php
Add to the render function before the return:
```
if ($this->isHttpException($e)) {
	\Statistic::httpError($request, $e);
} else {
	\Statistic::fatalError($request, $e);
}
```

_* Steps 4,5 are not necessary if you don't have user authentication_

Step 4:

Run:
```
php artisan vendor:publish
```

Step 5:

Edit the _<b>config/statistics.php</b>_ file.

Please enter the column names from your user database table.

For example:
```
  'user_id' => 'email',
  'first_name' => 'first_name',
	'last_name' => 'last_name',
	'protected_fields' => ['password'],
```
