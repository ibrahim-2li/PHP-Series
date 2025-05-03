<?php

require 'functions.php';
require 'Database.php';
require 'Response.php';
require 'router.php';
// connect to our MySQL database.

$config = require('config.php');
$db = new Database($config['database']);
