<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminLoginForm extends Component
{
    public $login_id, $password;
    public $returnUrl;

    public function mount()
    {
        $this->returnUrl = request()->returnUrl;
    }

    public function LoginHandler()
    {
        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if($fieldType == 'email'){
            $this->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:8'
            ],[
                'login_id.required' => 'Email or username is required',
                'login_id.email' => 'Invalid email address',
                'login_id.exists' => 'This email is not registered in database',
                'password.required' => 'Password is required'
            ]);
        } else {
            $this->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:8'
            ],[
                'login_id.required' => 'Email or username is required',
                'login_id.exists' => 'Username is not registered in database',
                'password.required' => 'Password is required'
            ]);
        }


        $creds = array($fieldType=>$this->login_id, 'password'=>$this->password);
        if(Auth::guard('web')->attempt($creds)) {
            $checkUser = User::where($fieldType, $this->login_id)->first();
            if($checkUser->blocked == 1){
                Auth::guard('web')->logout();
                return redirect()->route('admin.login')->with('fail','Your account had been blocked');
            } else {
                // return redirect()->route('admin.home');
                if($this->returnUrl != null)
                {
                    return redirect()->to($this->returnUrl);
                } else {
                    redirect()->route('admin.home');
                }
            }
        } else {
            session()->flash('fail','Incorrect Email/Username or password');
        }
    }

    public function render()
    {
        return view('livewire.admin-login-form');
    }
}
