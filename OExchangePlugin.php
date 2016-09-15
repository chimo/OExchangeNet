<?php
if (!defined('GNUSOCIAL')) {
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
    function onStartHostMetaLinks(&$links)
    {
        $url = common_local_url('oexchangexrd');        
        $links[] = new XML_XRD_Element_Link('http://oexchange.org/spec/0.8/rel/resident-target',
                       $url,
                       'application/xrd+xml');
        return true;
    }
}
