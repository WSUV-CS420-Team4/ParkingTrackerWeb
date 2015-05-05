<?php
class Controller_Auth extends Controller_Template
{
  public function action_login() {
    // already logged in?
    if (Auth::check())
    {
      // yes, so go back to the page the user came from, or the
      // application dashboard if no previous page can be detected
      Messages::info(__('login.already-logged-in'));
      Response::redirect_back('dashboard');
    }

    // was the login form posted?
    if (Input::method() == 'POST')
    {
      // check the credentials.
      if (Auth::instance()->login(\Input::param('username'), \Input::param('password')))
      {
        // did the user want to be remembered?
        if (Input::param('remember', false))
        {
          // create the remember-me cookie
          Auth::remember_me();
        }
        else
      {
          // delete the remember-me cookie if present
          Auth::dont_remember_me();
        }

        // logged in, go back to the page the user came from, or the
        // application dashboard if no previous page can be detected
        Response::redirect_back('dashboard');
      }
      else
      {
        // login failed, show an error message
        Messages::error(__('login.failure'));
      }
    }

    // display the login page
    return View::forge('login/login');
  }

  public function action_logout()
  {
    // remove the remember-me cookie, we logged-out on purpose
    Auth::dont_remember_me();

    // logout
    Auth::logout();

    // inform the user the logout was successful
    Messages::success(__('login.logged-out'));

    // and go back to where you came from (or the application
    // homepage if no previous page can be determined)
    Response::redirect_back();
  }
}

?>
