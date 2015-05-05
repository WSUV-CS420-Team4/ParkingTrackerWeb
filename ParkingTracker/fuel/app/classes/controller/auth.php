<?php
class Controller_Auth extends Controller_Template
{
  public function action_login() {
    // already logged in?
    if (\Auth::check())
    {
      // yes, so go back to the page the user came from, or the
      // application dashboard if no previous page can be detected
      Response::redirect_back('dashboard');
    }

    // was the login form posted?
    if (Input::method() == 'POST')
    {
      // check the credentials.
      if (\Auth::instance()->login(\Input::param('username'), \Input::param('password')))
      {
        // logged in, go back to the page the user came from, or the
        // application dashboard if no previous page can be detected
        Response::redirect_back();
      }
      else
      {
        // login failed, show an error message
        //Messages::error(__('login.failure'));
      }
    }

    // display the login page
    $this->template->title = "Login";
    $this->template->content = View::forge('auth/login');
  }

  public function action_logout()
  {

    // logout
    \Auth::logout();

    // inform the user the logout was successful
    //Messages::success(__('login.logged-out'));

    // and go back to where you came from (or the application
    // homepage if no previous page can be determined)
    Response::redirect_back();
  }
}

?>
