<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\item;
use Validator;
class AuthController extends Controller
{
    //
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


    /******************************/
    public function index()
    {
        $item = item::all();
        return response()->json($item);
    }

    public function find(Request $request)
    {   
        $validator = Validator::make($request->all(),[
            'id' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()]);
        } 
        $item = item::find($request->input('id'));
        return response()->json($item);
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [ 
            'itemname'=> 'required', 
            'price' => 'required|numeric', 
            // 'password' => 'required', 
            // 'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails())
        { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        else
        {
            $item  = new item;
            $item->itemname = $request->input('itemname');;
            $item->price = $request->input('price');
            $item->save();
            return response()->json(['message'=>"Success record has been added.",'details'=>$item]);
        }
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $item = item::find($id);
        $item->itemname = $request->input('itemname');
        $item->price = $request->input('price');

        
        $validator = Validator::make($request->all(), [ 
            'id' => 'required',
            'itemname' => 'required', 
            'price' => 'required|numeric', 
            // 'password' => 'required', 
            // 'c_password' => 'required|same:password', 
        ]);
        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()]);
        }
        else
        {
            $item->save();
            return response()->json(['message'=>"Successfully updated.",'detail'=>$item]);
        }
            
    }

    public function destroy($id)
    {
        $item = item::find($id);
        $item->delete();

        return response()->json(['message'=>"Success record has bean deleted",'details'=>$item]);
    }
}
