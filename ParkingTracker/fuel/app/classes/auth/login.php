<?php

class Auth_Login_Myauth extends \Auth_Login_Driver
{
	/**
	 * Load the config and setup the remember-me session if needed
	 */
	public static function _init()
	{

	}

	/**
	 * @var  Database_Result  when login succeeded
	 */
	protected $user = null;


	/**
	 * @var  array  SimpleAuth class config
	 */
	protected $config = array(
		//'drivers' => array('group' => array('Simplegroup')),
		//'additional_fields' => array('profile_fields'),
	);

	/**
	 * Check for login
	 *
	 * @return  bool
	 */
	protected function perform_check()
	{
		// fetch the username and login hash from the session
		$token  = \Session::get('token');

		$result = \DB::query("SELECT UserId FROM Session WHERE SessionToken = :Token")->execute(array("Token" => $token));

    if (count($result) > 0) {
      return true;
    }

		\Session::delete('username');
		\Session::delete('token');

		return false;
	}

	/**
	 * Check the user exists
	 *
	 * @return  bool
	 */
	public function validate_user($username, $password = '')
	{
    //Verify user/password
    $result = \DB::query("SELECT UserId, Password FROM User WHERE Name=:username")->execute(array("username" => $username);

    if ($result) {
      $hash = $result['Password'];
      if (password_verify($password, $hash)) {
        //Create session
        $sessionToken = bin2hex(openssl_random_pseudo_bytes(32));
        \DB::query("INSERT INTO Session (UserId, SessionToken, LastSeen) VALUES (:userid, :token, NOW())")->execute(array("userid" => $result['UserId'], "token" => $sessionToken));

        //Keep password formats up to date
        if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
          $hash = password_hash($password, PASSWORD_DEFAULT);
          \DB::query("UPDATE User SET Password=:password WHERE UserId=:userid")->execute(array("userid" => $result['UserId'], "password" => $hash));
        }

        return $sessionToken;
      } else {
        //Bad password
        return false;
      }
    } else {
      //Bad user
      return false;
    }

    return false;
	}

	/**
	 * Login user
	 *
	 * @param   string
	 * @param   string
	 * @return  bool
	 */
	public function login($username = '', $password = '')
	{
		if (!($token = $this->validate_user($username, $password)))
		{
			\Session::delete('username');
			\Session::delete('token');
			return false;
		}

		// register so Auth::logout() can find us
		Auth::_register_verified($this);

		\Session::set('username', $username);
		\Session::set('token', $token);
		\Session::instance()->rotate();
		return true;
	}

	/**
	 * Force login user
	 *
	 * @param   string
	 * @return  bool
	 */
	public function force_login($user_id = '')
	{
		if (empty($user_id))
		{
			return false;
		}

		\Session::set('username', $this->user['username']);
		\Session::set('login_hash', $this->create_login_hash());
		return true;
	}

	/**
	 * Logout user
	 *
	 * @return  bool
	 */
	public function logout()
	{
		\Session::delete('username');
		\Session::delete('token');
		return true;
	}

	/**
	 * Create new user
	 *
	 * @param   string
	 * @param   string
	 * @param   string  must contain valid email address
	 * @param   int     group id
	 * @param   Array
	 * @return  bool
	 */
	public function create_user($username, $password, $email, $group = 1, Array $profile_fields = array())
	{
		$password = trim($password);
		$email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);

	}

	/**
	 * Update a user's properties
	 * Note: Username cannot be updated, to update password the old password must be passed as old_password
	 *
	 * @param   Array  properties to be updated including profile fields
	 * @param   string
	 * @return  bool
	 */
	public function update_user($values, $username = null)
	{

	}

	/**
	 * Change a user's password
	 *
	 * @param   string
	 * @param   string
	 * @param   string  username or null for current user
	 * @return  bool
	 */
	public function change_password($old_password, $new_password, $username = null)
	{

	}

	/**
	 * Generates new random password, sets it for the given username and returns the new password.
	 * To be used for resetting a user's forgotten password, should be emailed afterwards.
	 *
	 * @param   string  $username
	 * @return  string
	 */
	public function reset_password($username)
	{

	}

	/**
	 * Deletes a given user
	 *
	 * @param   string
	 * @return  bool
	 */
	public function delete_user($username)
	{

	}

	/**
	 * Get the user's ID
	 *
	 * @return  Array  containing this driver's ID & the user's ID
	 */
	public function get_user_id()
	{
		$token = \Session::get('token');

    $result = \DB::query("SELECT UserId FROM Session WHERE SessionToken = :Token")->execute(array("Token" => $token));

    if ($result) {
      return array($this->id, $result['UserId']);
    }

    return false;
	}

	/**
	 * Get the user's groups
	 *
	 * @return  Array  containing the group driver ID & the user's group ID
	 */
	public function get_groups()
	{
		if (empty($this->user))
		{
			return false;
		}

		return array(array('', ''));
	}

	/**
	 * Get the user's emailaddress
	 *
	 * @return  string
	 */
	public function get_email()
	{
		return false;
	}

	/**
	 * Get the user's screen name
	 *
	 * @return  string
	 */
	public function get_screen_name()
	{
    $token = \Session::get('token');

    $result = \DB::query("SELECT U.Name FROM Session AS S INNER JOIN User AS U ON S.UserId=U.UserID WHERE SessionToken = :Token")->execute(array("Token" => $token));

    if ($result) {
      return array($this->id, $result['Name']);
    }

    return false;
	}

	/**
	 * Extension of base driver because this supports a guest login when switched on
	 */
	public function guest_login()
	{
		return false;
	}
}

// end of file simpleauth.php

?>
