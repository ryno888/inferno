<?php

namespace mod;

/**
 * @package mod\debug
 * @author Ryno Van Zyl
 * svg library https://undraw.co/
 */
class user extends \mod\intf\standard {

	/**
	 * @var \db\person
	 */
	public $active_user = false;
	public $active_id = false;
	public $active_role = false;

	//--------------------------------------------------------------------------------
	public function __construct($options = []) {
		$this->init_active_user($options);
	}

	//--------------------------------------------------------------------------------
	public function init_active_user($options = []) {

		$options = array_merge([
		    "user" => false
		], $options);

		if(!$options["user"]){
			$this->active_user = session()->get("active_user");
			$this->active_id = session()->get("active_id");
		}else{
			$this->active_user = $options["user"];
			$this->active_id = $this->active_user->id;

			session()->set("active_user", $this->active_user);
			session()->set("active_id", $this->active_id);
		}

		return $this->active_user;
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $username
	 * @param $password
	 * @param array $options
	 * @return array|\db\person|db\row|intf\standard|string
	 */
	public function login($username, $password, $options = []) {
		$options = array_merge([
		], $options);

		if($this->active_user)
			return \mod\http::go_error(ERROR_CODE_ACTIVE_USER_SESSION);

		//authenticate
		$authenticated = self::authenticate($username, $password);

		if(!$authenticated)
			return \mod\http::go_error(ERROR_CODE_INVALID_USERNAME_PASSWORD);

		//check inactive
		if($authenticated->per_is_active == 0)
			return \mod\http::go_error(ERROR_CODE_ACCOUNT_INACTIVE);

		//create user session
		return $this->init_active_user(["user" => $authenticated]);
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param array $options
	 * @return string
	 */
	public function logout($options = []) {
		$options = array_merge([
		], $options);

		if(!$this->active_user)
			return \mod\http::go_home();


		$this->active_user = false;
		$this->active_id = false;

		session()->set("active_user", $this->active_user);
		session()->set("active_id", $this->active_id);

		//create user session
		return \mod\http::go_home();
	}
	//--------------------------------------------------------------------------------
	/**
	 * @param $username
	 * @param $password
	 * @param array $options
	 * @return array|false|db\row|intf\standard|\db\person
	 */
	public static function authenticate($username, $password, $options = []) {
		$options = array_merge([
		], $options);

		try{
			$person = \core::dbt("person")->find([
				".per_username" => $username,
			]);

			if (password_verify($password, $person->per_password)) {
				return $person;
			}

		}catch(\Exception $ex){
			error::create($ex->getMessage());
		}

		return null;
	}
	//--------------------------------------------------------------------------------
}