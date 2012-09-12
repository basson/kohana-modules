<?php

defined('SYSPATH') or die('No direct script access.');

class Kohana_Alerts {

    const ALERTS_ERROR = 'error';
    const ALERTS_SUCCESS = 'success';
    const ALERTS_INFO = 'info';
    const ALERTS_WARNING = 'warning';

    protected $config = array (
	"views" => "alerts/",
    );
    protected $_type = self::ALERTS_INFO;
    protected $_alerts_array = NULL;
    protected $_title = NULL;

    /**
     * Создание новго обьекта Alerts
     *
     * @param string Тип уведомления
     * @param array  Массив с текстом уведомлений
     * @param string Заголовок уведомления
     * @param string Название группы конфига
     * @return  void
     */
    public static function factory($type, $alerts_array, $title = NULL, $group= NULL)
    {
	return new Alerts($type, $alerts_array, $title, $group);
    }

    /**
     * Создание новго обьекта Alerts
     *
     * @param string Тип уведомления
     * @param array  Массив с текстом уведомлений
     * @param string Заголовок уведомления
     * @param string Название группы конфига
     * @return  void
     */
    public function __construct($type, $alerts_array, $title = NULL, $group = NULL)
    {
	if(! is_string($group))
	{
	    $group = "default";
	}
	//$this->config = Kohana::$config->load('alerts')->get($group);
	$this->config = Kohana::$config->load('alerts')->get($group);
	$this->_type = $type;
	$this->_alerts_array = $alerts_array;
	$this->_title = $title;
    }

    /**
     * Рендер уведомлений
     *
     * @return  void
     */
    public function render()
    {
	$view = $this->config['views'].$this->_type;
	$view = View::factory($view)->bind('alerts', $msg)->bind('title', $this->_title);
	foreach ($this->_alerts_array as $alerts)
	{
	    if (is_array($alerts))
	    {
		foreach ($alerts as $alert)
		{
		    $msg.= '<p>'.$alert.'</p>';
		}
	    }
	    else
	    {
		$msg.= '<p>'.$alerts.'</p>';
	    }
	}
	return $view->render();
    }

}

?>
