<?php
namespace NotAnNSASpy\Nuonce;
class Nuonce
{
    private $nonce;
    private $action;
    protected function __construct ($action, $nonce){
        $this->action = ( $action == NULL ) ? ' nonce_action' : $action;
        $this->nonce = ( $nonce == NULL ) ? '_wpnonce' : $nonce;
    }
    private function getnonce(){
    return $this->nonce;
    }
    public function getAction(){
        return $this->action;
    }
    public static function url( $url ){
        if (!function_exists('wp_nonce_url') || empty ( $url ) || !is_string ($url))
            return false;
    return wp_nonce_url( $url, $this->action, $this->nonce );
    }
    public static function field( $referer = true ){
        if (!function_exists('wp_nonce_field'))
            return false;
        return wp_nonce_field( $this->action, $this->nonce, $referer, false);
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
    public static function AjaxReferer($queryArg, $die = true){
        if (!function_exists('check_ajax_referer'))
            return false;
        return check_ajax_referer( $this->action, $queryArg, $die);
    }
}
