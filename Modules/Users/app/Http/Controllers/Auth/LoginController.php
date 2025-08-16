<?php

namespace Modules\Users\Http\Controllers\Auth;

use App\Helpers\ResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Http\Requests\Auth\LoginRequest;
use Modules\Users\Models\User;
use Modules\Users\Transformers\UserResource;

class LoginController extends Controller
{
    use ResponseTrait;

    /**
     * Invoke Login method
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::whereEmail($request->email)->firstOrFail();

        if (!Hash::check($request->password, $user->password)) {
            return $this->json(message: "invalid Email or Password", status: 403);
        }

        return $this->json(
            [
                'token' => $user->createToken('accecss-token' . $user->email)->plainTextToken,
                'user' => UserResource::make($user),
            ],
            'Logged in successfully'
        );
    }
}
