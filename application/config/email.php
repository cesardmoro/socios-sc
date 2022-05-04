<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['email'] =array();
$config['email']['protocol']    = 'smtp';
$config['email']['smtp_host']    = 'mail.somoscerveceros.com';
$config['email']['smtp_port']    = '465';
$config['email']['smtp_timeout'] = '5';
$config['email']['smtp_user']    = 'no-reply@socios.somoscerveceros.com';
$config['email']['smtp_crypto']    = 'ssl';
$config['email']['smtp_pass']    = '6TQhTQqkhTd7mvH'; 
$config['email']['charset']    = 'utf-8';
$config['email']['newline']    = "\r\n"; 
$config['email']['mailtype'] = 'text'; // or html 
$config['email']['validation'] = false; // bool whether to validate email or not      
/*
 //gmail - funciona
defined('BASEPATH') OR exit('No direct script access allowed');
$config['email'] =array();
$config['email']['protocol']    = 'smtp';
$config['email']['smtp_host']    = 'smtp.gmail.com';
$config['email']['smtp_port']    = '465';
$config['email']['smtp_timeout'] = '5';
$config['email']['smtp_user']    = 'sistemasocios@gmail.com';
$config['email']['smtp_crypto']    = 'ssl';
$config['email']['smtp_pass']    = 's1st3m4s0c10s'; 
$config['email']['charset']    = 'utf-8';
$config['email']['newline']    = "\r\n"; 
$config['email']['mailtype'] = 'text'; // or html 
$config['email']['validation'] = false; // bool whether to 
*/