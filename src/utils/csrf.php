<?php
function genereteCsrf(){
        
        if(isset($_SESSION['tolkenCsrf'])){
            unset($_SESSION['tolkenCsrf']);
        }

        $_SESSION['tolkenCsrf'] = md5(uniqid(32));

        return '<input type="hidden" id="tolkenCsrf" name="tolkenCsrf" value="'.$_SESSION['tolkenCsrf'].'">';
    }
function validateTolkenCsrf($tolken){
        if(!isset($_SESSION['tolkenCsrf'])){
            return "tolken invalido";
        }

        if($_SESSION['tolkenCsrf'] !== $tolken){
            return 'tolken invalido';
        }

        unset($_SESSION['tolkenCsrf']);

        return TRUE;
    }