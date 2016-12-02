<?php

namespace lib\logger;

// Permet de logger (info, erreur, etc...) 
function logger_log($type = 'error', $message)
{
    $message = '['.date('d/m/Y H:i:s').'] ['.$type.'] '.$message;
    
    $fh = fopen(__DIR__.'/../logs/error.log', 'a+');  
    fwrite($fh, $message.PHP_EOL);
    fclose($fh);
}

// Handler chargé de logger les erreurs php
function logger_error_handler($errno, $errstr, $errfile, $errline)
{
    logger_log('error', $errfile.':'.$errline.' : '.$errstr);
}

// Handler chargé de logger les exceptions php
function logger_exception_handler(\Exception $exception)
{
    logger_log('error', $exception->getFile().':'.$exception->getLine().' : '.$exception->getMessage());
}

// Connecte des handlers custom pour gerer les erreurs applicatives
function logger_register()
{
    set_error_handler('lib\logger\logger_error_handler');
    set_exception_handler('lib\logger\logger_exception_handler');
}

