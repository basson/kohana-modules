README 

Модуль для вывода сообщений Alerts. 

Подключить в bootstrap.php 

```php
<?php
	Kohana::modules(array(
	...
	'alerts' => MODPATH.'alerts',
	));
?>
```

Ипользовать так:

```php
<?php 
public function action_index()
{
	echo Alerts::factory(Alerts::ALERTS_SUCCESS, array('Текст уведомления'), 'Заголовок уведомления')->render();
}
?>
```

 или так (вывод сообщений валидации): 

```php
<?php
public function action_index()
{
	try
	{
		$user = new Model_User;
		$user->create_user($value, array('username', 'password', 'email',));
	}
	catch (Kohana_ORM_Validation_Exception $e)
	{
		echo Alerts::factory(Alerts::ALERTS_ERROR, $e->errors('models'))->render();
	}
}
?>
```

 Модуль для вывода медиа файлов и js Media. 
 Подключить в bootstrap.php 

```php
<?php
	Kohana::modules(array(
	...
	'media' => MODPATH.'media',
	));
?>
```

Ипользовать так:

В нужном экшене подключаем файлы : 

```php
<?php
public function action_index()
{
	Media::factory()->add('bootstrap-tooltip', Media::JS);
}
?>
```

В представлении выводим : 

```php
<?php
	// Файлы js
echo Media::factory()->render(Media::JS);
	// Файлы css
echo Media::factory()->render(Media::CSS);
?>
```