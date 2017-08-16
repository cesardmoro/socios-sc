<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['email'] =array();
$config['email']['protocol']    = 'smtp';

$config['email']['smtp_host']    = 'mail.somoscerveceros.com.ar';
$config['email']['smtp_port']    = '587';
$config['email']['smtp_timeout'] = '587';
$config['email']['smtp_user']    = 'socios@somoscerveceros.com.ar';
$config['email']['smtp_pass']    = 'NT4302wqsjasdo'; 

$config['email']['smtp_host']    = '';
$config['email']['smtp_port']    = '';
$config['email']['smtp_timeout'] = '';
$config['email']['smtp_user']    = '';
$config['email']['smtp_pass']    = ''; 

$config['email']['charset']    = 'utf-8';
$config['email']['newline']    = "\r\n"; 
$config['email']['mailtype'] = 'text'; // or html 
$config['email']['validation'] = false; // bool whether to validate email or not      

