<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;

class AccountController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $data['menu'] = 'account';
        $data['user'] = auth()->user();

        return view('pages.profile.index', $data);
    }

    public function save(AccountRequest $request): RedirectResponse
    {
        // except token request
        $request->request->remove('_token');

        // set avatar default
        $request->merge(['avatar' => auth()->user()->avatar]);

        // override avatar if exists
        if ($request->hasFile('photo')) {
            $request = app(HelperController::class)->getAvatar($request);
        }

        dd($request->all());
        $this->userRepository->updateUser(auth()->user()->id, $request->all());

        return redirect()->back()->with('success', 'Successfully saved');
    }
}
