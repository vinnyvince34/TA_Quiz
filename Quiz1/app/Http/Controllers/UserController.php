<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserModel;
use Exception;

Class UserController extends Controller
{
    protected $user;

    public function __construct(UserModel $user)
    {
      $this->user =$user;
    }
    public function register(Request $request)
    {
      $user = [
        "id" => $request->id,
        "name" => $request->name,
        "email" => $request->email,
        "password" => md5($request->password)
      ];

      try
      {
        $users = $this->user->create($user);
        return response('Created', 201);
      }
      catch(Exception $ex)
      {
        return reponse('Failed', 400);
      }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $query = $this->user->find($id);

            $id = $request->id;
            $name = $request->name;
            $email =  $request->email;
            $password = $request->password;

            $update = $query->save();

            return response('Updated', 201);
        }
        catch(Exception $ex)
        {
            return $ex;
            return response('Failed', 400);
        }
    }

    public function delete($id)
    {
        try
        {
            $deletedUser = $this->user->where('id',$id)->delete();
            return response('Deleted', 201);
        }
        catch(Exception $ex)
        {
            return response('Failed', 400);
        }
    }

    public function all()
    {
      $users = $this->user->all();
      return view("all")->with('users',$users);
    }

    public function find($id)
    {
      $user = $this->user->find($id);

      return $user;
    }
}
 ?>
