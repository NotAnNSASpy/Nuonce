<?php
namespace NotAnNSASpy\Nuonce;
class Nuonce
{
    private $action;
    public function getAction(){
        return $this->action;
    }
    protected function __construct ($action){
        $this->action = ( $action == NULL ) ? ' nonce_action' : $action;
    }
}
class Something extends Nuonce
{
    private $nonce;
    private static function getnonce(){
    return $this->nonce;
    }
    protected function __construct($nonce) {
        parent::__construct($action);
        $this->nonce = ( $nonce == NULL ) ? '_wpnonce' : $nonce;
    }
    public static function url( $url ){
        if (!function_exists('wp_nonce_url') || empty ( $url ) || !is_string ($url))
            return false;
    return wp_nonce_url( $url, $this->action, $this->nonce );
    }
    public static function field( $referer = true ){
        if (!function_exists('wp_nonce_field'))
            return false;
        return wp_nonce_field( $this->action, $this->action, $referer, false);
    }
    public static function create(){
        if (!function_exists('wp_create_nonce'))
            return false;
        return wp_create_nonce ( $this->action );
    }
    public static function verify(){
        if (!function_exists('wp_verify_nonce'))
            return false;
        return wp_verify_nonce( $this->nonce);
    }
    public static function AdminReferer(){
        if (!function_exists('check_admin_referer'))
            return false;
        return check_admin_referer( $this-> action, $this->nonce);
    }
    public static function AjaxReferer($die = true){
        if (!function_exists('check_ajax_referer'))
            return false;
        return check_ajax_referer( $this->action, $this->nonce, $die);
    }
}
