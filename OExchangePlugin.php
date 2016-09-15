<?php
if (!defined('STATUSNET')) {
    exit(1);
}

/**
 * @package OExchange
 * @author Matthias Pfefferle <pfefferle@pfefferle.status.net>
 */
class OExchangePlugin extends Plugin
{
    /**
     * Hook for RouterInitialized event.
     *
     * @param Net_URL_Mapper $m path-to-action mapper
     * @return boolean hook return
     */
    function onRouterInitialized($m)
    {
        // Discovery actions
        $m->connect('.well-known/oexchange.xrd',
                    array('action' => 'oexchangexrd'));
        // Discovery actions
        $m->connect('oexchange/offer',
                     array('action' => 'oexchangeoffer'));
        return true;
    }

    /**
     * Adds oexchange link to the host-meta file
     *
     * @param array $links
     * @return boolean hook return
     */
    function onStartHostMetaLinks($links)
    {
        $url = common_local_url('oexchangexrd');        
        $links[] = array('rel' => 'http://oexchange.org/spec/0.8/rel/resident-target',
                       'type' => 'application/xrd+xml',
                       'href' => $url);
        return true;
    }
}
