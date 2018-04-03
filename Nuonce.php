<?php
namespace Darkflameninja\Nuonce;
class Nuonce
{
    private $nonce;
    private $action;
    function __construct ($action = '', $nonce = ''){
        $this->action = ( $action == NULL ) ? ' nonce_action' : $action;
        $this->nonce = ( $nonce == NULL ) ? '_wpnonce' : $nonce;
    }
    public function getnonce(){
        return $this->nonce;
    }
    public function getAction(){
        return $this->action;
    }
    public function url( $url, $name ){
        if (!function_exists('wp_nonce_url') || empty ( $url ) || !is_string ( $url ) )
            return false;
    return wp_nonce_url( $url, $this->action, $name );
    }
    public function field($name, $referer = true ){
        if (!function_exists('wp_nonce_field') || empty ( $name ) || !is_string( $name ) )
            return false;
        return wp_nonce_field( $this->action, $name, $referer, false);
    }
    public function create(){
        if (!function_exists('wp_create_nonce') || empty ( $this->action ))
            return false;
        return wp_create_nonce ( $this->action );
    }
    public function verify(){
        if (!function_exists('wp_verify_nonce') || empty ( $this->nonce )  || !is_string ( $this->nonce ) )
            return false;
        return wp_verify_nonce( $this->nonce, $this->action );
    }
    public function AdminReferer($queryArg ){
        if (!function_exists('check_admin_referer'))
            return false;
        return check_admin_referer($this->action, $queryArg );
    }
    public function AjaxReferer($queryArg, $die = true){
        if (!function_exists('check_ajax_referer'))
            return false;
        return check_ajax_referer( $this->action, $queryArg, $die );
    }
}
