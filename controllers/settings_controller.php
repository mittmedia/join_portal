<?php

namespace JoinPortal
{
  class SettingsController extends \WpMvc\BaseController
  {
    public function index()
    {
      global $current_site;
      global $site;
      global $registration_options;

      $site = \WpMvc\Site::find( $current_site->id );

      $this->create_attribute_if_not_exists( $site, 'activate_registration' );
      $this->create_attribute_if_not_exists( $site, 'welcome_text' );

      if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        $site->takes_post( $_POST['site'] );

        $site->save();

        static::redirect_to( "{$_SERVER['REQUEST_URI']}&join_portal_updated=1" );
      }

      $registration_options = array();

      $this->get_registration_options( $registration_options );

      $this->render( $this, "index" );
    }

    private function create_attribute_if_not_exists( &$site, $attribute )
    {
      if ( ! isset( $site->sitemeta->{$attribute} ) ) {
        $site->sitemeta->{$attribute} = \WpMvc\SiteMeta::virgin();
        $site->sitemeta->{$attribute}->site_id = $site->id;
        $site->sitemeta->{$attribute}->meta_key = "$attribute";
        $site->sitemeta->{$attribute}->meta_value = "";
        $site->sitemeta->{$attribute}->save();
      }
    }

    private function get_registration_options( &$registration_options )
    {
      $options = array(
        \JoinPortal\SettingsHelper::activation_option_to_text(0),
        \JoinPortal\SettingsHelper::activation_option_to_text(1),
        \JoinPortal\SettingsHelper::activation_option_to_text(2)
      );

      foreach ( $options as $option ) {
        array_push( $registration_options, $option );
      }
    }
  }
}