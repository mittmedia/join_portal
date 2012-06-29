<?php

namespace JoinPortal
{
  class SettingsHelper
  {
    public static function activation_option_to_text( $code )
    {
      switch ( $code ) {
        case '0':
          return 'No';
        case '1':
          return 'Yes';
        case '2':
          return 'Yes, but invitation only';
      }
    }

    public static function activation_option_to_code( $text )
    {
      switch ( $code ) {
        case 'No':
          return 0;
        case 'Yes':
          return 1;
        case 'Yes, but invitation only':
          return 2;
      }
    }
  }
}