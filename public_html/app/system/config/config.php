<?php
$config = [
  'debug' => false,
  'smartyPath' => 'vendor/smarty/smarty/libs/',
  'templatesPath' => 'app/source',
  'themeFolder' => 'general',
];

define ('CONFIG', $config);
if (CONFIG['debug'] == false)
{
  //
}
else if (CONFIG['debug'] == true)
{
  //
}