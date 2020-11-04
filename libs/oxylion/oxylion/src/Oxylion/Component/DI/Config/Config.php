<?php declare(strict_types=1);
namespace Oxylion\Component\Config;

class Config
{
    private static ?Config $instance = null;
    
    protected function __construct() { }

    /**
     * Cloning and un serialization are not permitted for singletons.
     */
    protected function __clone() { }
    public function __wakeup() {
        throw new \LogicException("[exception(logic)]: you can not un serialize singleton instance.");
    }
    
    /**
     * function:    getInstance()
     * 
     * @return Config instance
     */
    public static function getInstance() 
    {
        if (self::$instance===null) {
            self::$instance = new static();
        } 
        
        return self::$instance;
    }
}