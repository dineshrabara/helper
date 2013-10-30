<?php

namespace Dinesh\Helper\Facades;

use Illuminate\Support\Facades\Facade;

class DNSFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'DNS';
    }

}