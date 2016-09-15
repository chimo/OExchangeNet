<?php
if (!defined('GNUSOCIAL')) {
  exit(1);
}

/**
 * @package OExchangePlugin
 * @author Matthias Pfefferle <pfefferle@pfefferle.status.net>
 */
class OExchangeXrdAction extends XrdAction
{
  private $sharelink;
  private $icon;
  private $icon32;

  /**
   * Handle the request
   *
   * @param array $args $_REQUEST data (unused)
   * @return void
   */
  function handle()
  {
    $domain = common_config('site', 'server');
    if (class_exists("BookmarkPlugin")) {
      $this->sharelink = common_local_url('bookmarkpopup');
    } else {
      $this->sharelink = common_local_url('oexchangeoffer');
    }

    if (defined('OEXCHANGE_ICON')) {
      $this->icon = OEXCHANGE_ICON;
    } else {
      $this->icon = common_path('plugins/OExchange/images/icon.png');
    }

    if (defined('OEXCHANGE_ICON32')) {
      $this->icon32 = OEXCHANGE_ICON32;
    } else {
      $this->icon32 = common_path('plugins/OExchange/images/icon32.png');
    }

    parent::handle();
  }

  protected function setXRD()
  {
     // Subject
     $this->xrd->subject = common_local_url('newnotice');

     // Properties
     $this->xrd->properties[] = new XML_XRD_Element_Property('http://www.oexchange.org/spec/0.8/prop/vendor', common_config('site', 'broughtby'));
     $this->xrd->properties[] = new XML_XRD_Element_Property('http://www.oexchange.org/spec/0.8/prop/title', common_config('site', 'name'));
     $this->xrd->properties[] = new XML_XRD_Element_Property('http://www.oexchange.org/spec/0.8/prop/name', 'GNU social Version ' . GNUSOCIAL_VERSION);
     $this->xrd->properties[] = new XML_XRD_Element_Property('http://www.oexchange.org/spec/0.8/prop/prompt', 'Share with your ' . common_config('site', 'name') . ' network!');

     // Links
     $this->xrd->links[] = new XML_XRD_Element_Link('icon', $this->icon, 'image/png');
     $this->xrd->links[] = new XML_XRD_Element_Link('icon32', $this->icon32, 'image/png');
     $this->xrd->links[] = new XML_XRD_Element_Link('http://www.oexchange.org/spec/0.8/rel/offer', $this->sharelink, 'text/html');
  }
}
