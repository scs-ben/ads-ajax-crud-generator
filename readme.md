ads-ajax-crud-generator
==============

<h3>Agility Data Systems Scaffolding Generator for AJAX Crud</h3>

This module creates partial files to use in conjunction with the AJAX Crud JS plugin (https://github.com/DavidVranish/AjaxCrud)

Step 1:

Set up composer, add the package to your require tag:
```
"ads/ajax-crud-generator": "dev-master"
```

run
```
php composer update
```

Step 2:
Add service provider to app/config/app.php
```
'Ads\Statistics\AjaxCrudServiceProvider',
```

Step 3:
Publish the necessary files

Run:
```
php artisan vendor:publish
```

Step 4:
Set up the location to the AjaxCrud plugin

If you are using Bower, there is no need to modify to config file, simply add this line to your bower.json file:
```
"ajax_crud": "git@github.com:DavidVranish/AjaxCrud.git"
```

If you are not going to use Bower to, you need to modify the config file to point to the location of AjaxCrud[.min].js file: 

For example:
```
  'ajax_crud_js_path' => '/public/js/ajax_crud/js/AjaxCrud.min.js',
```

Step 5:
Add AjaxCrud.js plugin to your main layout file:

```
<script type="text/javascript" src="{{ asset(Config::get('ajaxCrud.ajax_crud_js_path')) }}"></script>
```
