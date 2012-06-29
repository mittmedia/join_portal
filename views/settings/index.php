<?php global $site; global $registration_options; ?>

<div class="wrap">
  <div id="icon-options-general" class="icon32"><br></div>
  <h2><?php _e( 'Join Portal Settings' ); ?></h2>
  <?php

  $content = array(
    array(
      'title' => 'Activate Registration',
      'name' => $site->sitemeta->activate_registration->meta_key,
      'type' => 'select',
      'options' => $registration_options,
      'object' => $site->sitemeta->activate_registration,
      'default_value' => $site->sitemeta->activate_registration->meta_value,
      'key' => 'meta_value'
    ),
    array(
      'title' => 'Welcome Text',
      'name' => $site->sitemeta->welcome_text->meta_key,
      'type' => 'textarea',
      'object' => $site->sitemeta->welcome_text,
      'default_value' => \JoinPortal\SettingsHelper::activation_option_to_text( $site->sitemeta->welcome_text->meta_value ),
      'key' => 'meta_value'
    )
  );

  \WpMvc\FormHelper::render_form( $site, $content );

  ?>
</div>
