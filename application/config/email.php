<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
|   Email Configuration
|------------------------------------------------------------------------
 */
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://ampwork.com';
$config['smtp_port'] = '465';
$config['smtp_timeout'] = '60';

$config['smtp_user'] = 'project@ampwork.com';
$config['smtp_pass'] = 'Project@2017';
$config['charset'] = 'utf-8';
$config['newline'] = '\r\n';
$config['mailtype'] = 'html';
$config['validation'] = TRUE;