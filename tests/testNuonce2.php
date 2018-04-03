<?php
use Darkflameninja\Nuonce\Nuonce;
class NuonceTest extends \PHPUnit\Framework\TestCase {
	public function setUp() {
		\WP_Mock::setUp();
		require_once dirname( __FILE__ ) . '/../Nuonce.php';
	}
	public function tearDown() {
		\WP_Mock::tearDown();
	}
	public function test_create() {
		$action = 'nonce_action';
		$nonce = '34653456f';
		$myNonce = new Nuonce( $action, $nonce );
		\WP_Mock::wpFunction( 'wp_create_nonce', array(
				'times'  => 1,
				'return' => $nonce
			) );
		$this->assertEquals(
			$nonce,
			$myNonce->create()
		);
	}
	public function test_verify() {
		$nonce = '34653456f';
		$action = 'nonce_action';
		$myNonce = new Nuonce( $action, $nonce );
		\WP_Mock::wpFunction( 'wp_verify_nonce', array(
				'times'  => 3,
				'args'  => array($myNonce->getnonce(), $myNonce->getAction() ),
				'return_in_order' => array( 1, 2, false )
			) );
		$this->assertEquals(
			1,
			$myNonce->verify( $nonce )
		);
		$this->assertEquals(
			2,
			$myNonce->verify( $nonce )
		);
		$this->assertFalse(
			$myNonce->verify( 3245234452345234 )
		);
	}
	public function test_field() {
		$action = 'nonce_action';
		$nonce = '34653456f';
		$name = '_wpnonce';
		$myNonce = new Nuonce( $action, $nonce );
		$field = '<input type="hidden" id="' . $name . '" name="' . $name . '" value="34653456f" />';
		\WP_Mock::wpFunction( 'wp_nonce_field', array(
				'times'  => 1,
				'args'  => array( $myNonce->getAction(), $name, true, false ),
				'return' => $field
			) );
		$this->assertEquals(
			$field,
			$myNonce->field( $name )
		);
	}
	public function test_url() {
		$action = 'nonce_action';

		$nonce = '34653456f';
		$name = '_wpnonce';
		$url = 'http://my.wrdprss.com/foo/bar';
		$actionNonceUrl = 'http://my.wrdprss.com/foo/bar' . '?' . $name . '=' . $nonce;
		$myNonce = new Nuonce( $action, $nonce );
		\WP_Mock::wpFunction( 'wp_nonce_url', array(
				'times'  => 1,
				'args'  => array( $url, $myNonce->getAction(), $name ),
				'return' => $actionNonceUrl
			) );
		$this->assertEquals(
			$actionNonceUrl,
			$myNonce->url( $url, $name)
		);
	}
	public function test_AdminReferer() {
		$action = 'nonce_action';
		$query_arg = '_wpnonce_name';
		$myNonce = new Nuonce( $action );
		\WP_Mock::wpFunction( 'check_admin_referer', array(
				'times'  => 1,
				'args'  => array( $myNonce->getAction(), $query_arg ),
				'return' => true
			) );
		$this->assertTrue(
			$myNonce->AdminReferer( $query_arg )
		);
	} 
	public function test_AjaxReferer() {
		$action = 'nonce_action';
		$query_arg = '_wpnonce_name';
		$myNonce = new Nuonce( $action );
		\WP_Mock::wpFunction( 'check_ajax_referer', array(
				'times'  => 1,
				'args'  => array( $myNonce->getAction(), $query_arg, true ),
				'return' => true
			) );
		$this->assertTrue(
			$myNonce->AjaxReferer( $query_arg, true )
		);
	}
}
