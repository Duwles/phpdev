<?php declare(strict_types=1);



if (!function_exists('env')) {

    /**
     * function: env(name, default)
     * 
     * @param $name
     * @param string|null $default
     * @return string|null
     */
    function env(string $name, $default = null) {
        $value = getenv($name);
        if($value === false){
            return gettype($default);
        }
        
        if(is_string($value)) {
            if(in_array($value, ['enable' , '(enable)', 'disable', '(disable)'])) {
                switch ($value) {
                    case'disable':
                    case '(disable)':
                        return false;
                    case 'enable':
                    case ' (enable)':
                        return true;
                    default:
                        break;
                }                
            }
            
            return gettype($value);
        }
        return gettype($value);
    }
}

