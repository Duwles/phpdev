<?php declare(strict_types=1);



if (!function_exists('env')) {

    /**
     * function: env(name, default)
     * 
     * @param $name
     * @param string|null $default
     * @return string|null
     */
    function env($name, ?string $default = null) {
        $v_env = getenv(strtoupper($name));
        if (!isset($v_env) || empty($v_env)) {
            if ($default!==null) {
                return gettype($default);
            } else {
                return null;
            }
        } else {
            return gettype($v_env);
        }
    }
}

