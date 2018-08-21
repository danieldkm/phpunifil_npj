<?php

namespace app_unifil\Http\Controllers\Auth;

use Exception;

class Protector {
    
    private $passphrase = "unifil20170614dkm";
    
	private $private_key =  "AAABAE8t4ySdu8D94hDHfABtD6m5X9fv5L2THimkPgUV2cOZNyYY2Y9z0RTKdVsV".
                            "nu3P+dwYl/m1wXC1QEtY0jY6aJCWdYVHktkIQWhiLiWKn7I1dSRzHBLmbow3ZOV7".
                            "1pUXFt2kZZumhAXmxSFJJZ+/DItgyVaBUzM2p3+7d7T3A/WaiPgBNky8kKZcDL61".
                            "QK070P6XFaTuY8UI93pxTi0kGAXz2G8h76LySgIiMENiQVs/wkfwj6BBA2u3eTkV".
                            "rCK1fTYwpazUN5y6lCMaqV1uWbKJAiwr3cOThnA5B1j/4lCWm3kk1p+u59p8iL4u".
                            "pary9ZeGyy6xTyB74cvQaeS7EK0AAACBAPODfpGbVUXT0I7e3J9WNPq+dhWXuf2N".
                            "Cb1114ruPit/r7Zp9uU8b2TVC/0cdxXzc+V/EtUV5QfSY1AgPXFOSjDrAeZmIx6y".
                            "9v29Lc7k5O7x3hE3PlK3nyRd6qAwLx90/+QxPr38wcAuwZTJE9FtodASZPKuLu1n".
                            "N0kQG6Y+ylXhAAAAgQDb/UfeW2iugcMdZHG3sYy3Bk/YtXRieVqxx73avWyVSgRL".
                            "BhhYS9PvWFrfkbyKmJQGHzKvvq6LHKyJkL0l+NCcg8je1/qc2rf6jYu0+ylqeu1i".
                            "mIDWA1ZgDamnO3qsuMLkM86bwa0uvT7nOh7Sc/TlzrGrMk82/f1nmrUimFEGhQAA".
                            "AIEAqj0+sZ2l3s58gOEO9PG006sEkw8Ab4DAv2z8ADuGJ823nIFsy9LnlLw5j9gW".
                            "9dWAy3vfUnTOqeswQoewCNk9sfVWo8gvRm0DYKFktST+PnlaziMsFocWFwk1WeNK".
                            "UuIRHSVq+ghACC2ESVyxdCNqsVkOSxSoTJcSgTsf9hx7CoA=";
//Private-MAC: 4356bf1481f80f8cd9b8163edf27500381ad30f7
//                            ---- BEGIN SSH2 PUBLIC KEY ----
//                            Comment: "rsa-key-20170614"
	private $public_key =   "18159831080351862456113036692562107719309802015105549031028499857412100823615566492378896970209706919055787788342765814519024742366608501027078109287883178695902072726648203020471791105543779315200745937875007921689909542278797872419245064230588252977354232958507230786077762009281547079356816407292970078351459565610911511365502021144314250889160817640170812404491246413488656356164382025878899383139881021473199836296282362386156813398425395157015839791935800990208691643386227485975953239092139119259013355163862498091643341123970166218368650824801798779047101564199655881310195371879423173908524918754994351737707";
//                            ---- END SSH2 PUBLIC KEY ----
    
	public function __construct() {
        $config = array(
            "digest_alg" => "sha512",
            "private_key_bits" => 4096,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );

        // Create the private and public key
        $res = openssl_pkey_new($config);

        // Extract the private key from $res to $privKey
        openssl_pkey_export($res, $privKey);
        
        $this->private_key = $privKey;

        // Extract the public key from $res to $pubKey
        $pubKey = openssl_pkey_get_details($res);
        $pubKey = $pubKey["key"];
        
        $this->public_key = $pubKey;

        /*$data = 'plaintext data goes here';

        // Encrypt the data to $encrypted using the public key
        openssl_public_encrypt($data, $encrypted, $pubKey);

        // Decrypt the data using the private key and store the results in $decrypted
        openssl_private_decrypt($encrypted, $decrypted, $privKey);

        echo $decrypted;*/
        
	}
	public function __destruct() {
	}
    
	public function encrypt($unencrypted_data) {
		if (empty($this->public_key)) {
			throw new exception('Please set the public key before attempting encryption.');
		}
	
		$public_key = openssl_pkey_get_public($this->public_key);
		if (!$public_key) {
			throw new exception('Please set a valid public key before attempting encryption.');
		}
		$encrypted_data = '';
		openssl_public_encrypt($unencrypted_data, $encrypted_data, $public_key);
		return($encrypted_data);
	}
    
	public function decrypt($encrypted_data) {
		if (empty($this->private_key)) {
			throw new exception('Please set the private key before attempting decryption.');
		}
		$private_key = openssl_pkey_get_private($this->private_key, $this->passphrase);
		if (!$private_key) {
			throw new exception('Please set a valid private key before attempting decryption.');
		}
		$unencrypted_data = '';
		openssl_private_decrypt($encrypted_data, $unencrypted_data, $private_key);
		return($unencrypted_data);
	}
    
	public function set_passphrase($passphrase) {
		$this->passphrase = trim($passphrase);
		return($this);
	}
    
	public function set_private_key($private_key) {
		$this->private_key = trim($private_key);
		return($this);
	}
    
	public function set_public_key($public_key) {
		$this->public_key = trim($public_key);
		return($this);
	}
    
	public function get_private_key() {
		return($this->private_key);
	}
    
	public function get_public_key() {
		return($this->public_key);
	}
}