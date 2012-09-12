<?php
defined('SYSPATH') or die('No direct script access.');
class Kohana_Media {

    const CSS = 'css';
    const JS = 'js';

    protected $config = array(
	"path" => "assets",
    );
    protected $_root_path = 'assets';
    protected $_path = '';
    protected $_type = self::CSS;
    protected static $_styles = array();
    protected static $_scripts = array();

    /*
     * Создание нового обьекта Media
     * 
     * @param string Название группы конфига
     * @return void 
     */

    public static function factory($group = NULL)
    {
	return new Media($group);
    }

    /*
     * Создание нового обьекта Media
     * 
     * @param string Название группы конфига
     * @return void 
     */

    public function __construct($group = NULL)
    {
	if (!is_string($group))
	{
	    $group = "default";
	}
	$this->config = Kohana::$config->load('media')->get($group);
    }
    /*
     * Добавление файла CSS или JS
     * 
     * @param string Название файла
     * @param string Тип файла
     * 
     * return void
     */
    public function add($file, $type = Media::CSS)
    {
	$file = $this->config['path'].DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR.$file.'.'.$type;
	if ($type == self::CSS)
	{
	    Media::$_styles[] = $file;
	}
	else
	{
	    Media::$_scripts[] = $file;
	}
    }
    /*
     * Формирование медиа тегов
     * 
     * @param string Тип CSS или JS
     * 
     * @return string Медиа теги
     */
    protected function files($type)
    {
	$data = NULL;
	if ($type == self::CSS)
	{
	    foreach (Media::$_styles as $style)
	    {
		$data.= "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"$style\" />\n\t";
	    }
	}
	else
	{
	    foreach (Media::$_scripts as $script)
	    {
		$data.= "<script type=\"text/javascript\" src=\"$script\"></script>\n\t";
	    }
	}
	return $data;
    }

    /*
     * Рендер 
     * 
     * @param string Тип CSS или JS
     * 
     * @return string Медиа теги;
     */
    public function render($type = Media::CSS)
    {
	return $this->files($type);
    }

}

?>
