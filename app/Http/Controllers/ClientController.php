<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientProfileRequest;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function profile(string $id): View
    {
        $viewData = [];
        $viewData['title'] = 'LUME - My profile';
        $viewData['subtitle'] = 'My profile';
        $viewData['client'] = Client::findOrFail($id);

        return view('client.profile')->with('viewData', $viewData);
    }

    public function profileUpdate(ClientProfileRequest $request, string $id): RedirectResponse
    {
        $client = Client::findOrFail($id);

        $data = $request->only(['name', 'email', 'address', 'phone']);
        if ($request->filled('password')) {
            $data['password'] = $request->input('password');
        }

        $client->update($data);

        return redirect()->route('client.profile', ['id' => $id])->with('success', 'Profile updated successfully.');
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = 'Create Client';

        return view('admin.client.create')->with('viewData', $viewData);
    }

    public function save(ClientRequest $request): RedirectResponse
    {
        Client::create($request->only(['name', 'email', 'password', 'role', 'address', 'phone']));

        return redirect()->route('admin.client.index');
    }

    public function delete(string $id): RedirectResponse
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('admin.client.index');
    }

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'LUME - Clients';
        $viewData['subtitle'] = 'List of clients';
        $viewData['clients'] = Client::all();

        return view('admin.client.index')->with('viewData', $viewData);
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['title'] = 'Edit Client';
        $viewData['client'] = Client::findOrFail($id);

        return view('admin.client.edit')->with('viewData', $viewData);
    }

    public function update(ClientRequest $request, string $id): RedirectResponse
    {
     $client = Client::findOrFail($id);
    
   
    $data = $request->only(['name', 'email', 'role', 'address', 'phone']);

  
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->input('password'));
    }

    $client->update($data);

    return redirect()->route('admin.client.index');
    }
}
