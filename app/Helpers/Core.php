<?php


namespace App\Helpers;

use Illuminate\Support\Facades\App;

class Core
{
    /**
     * Check app initial setup
     *
     * @return boolean
     */
    public static function is_initialized(): bool
    {
        $is_running_test = App::runningUnitTests();
        $is_in_console = App::runningInConsole();
        if (!$is_running_test) {
            return false;
        }
        return true;
    }
}
