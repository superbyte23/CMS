<?php
  // App Root
  define('APPROOT', dirname(dirname(__FILE__)));
  // URL Root
  define('URLROOT', 'http://'.$_SERVER['SERVER_ADDR'].'/e-Judging');
  // pulblic folder
  define('ASSETS', URLROOT.'/public');
  // Site Name.
  define('SITENAME', 'E-Judging System');

  // Site Name.
  define('APPNAME', 'CMS');

  // version
  define('VERSION', 'Version 1.0.0');

  // Mysql DB
  define("DB_HOST", "localhost");
  define("DB_USER", "root");
  define("DB_PASS", "");
  define("DB_NAME", "judging");
  