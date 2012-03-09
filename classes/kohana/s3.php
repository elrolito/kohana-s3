<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_S3 extends Zend_Service_Amazon_S3 {
    
    /**
     * @var  string  default instance name
     */
    public static $default = 'default';
    
    /**
     * @var  array  S3 instances
     */
    public static $instances = array();
    
    public static function instance($name = NULL, array $config = NULL)
    {
        if ($name === NULL)
        {
            // Use the default instance name
            $name = S3::$default;
        }
        
        if ( ! isset(S3::$instances[$name]))
        {
            if ($config === NULL)
            {
                // Load the configuration for this S3
                $config = Kohana::$config->load('s3')->$name;
            }
            
            new S3($name, $config);
        }
        
        return S3::instance[$name];
    }
    
    protected $_instance;
    
    protected $_config;
    
    public function __construct($name, array $config)
    {
        // Set the instance name
        $this->_instance = $name;
        
        // Store the config locally
        $this->_config = $config;
        
        parent::__construct($config['access_key'], $config['secret_key']);
        
        // Store the S3 instance
        S3::$instances[$name] = $this;
    }
}
