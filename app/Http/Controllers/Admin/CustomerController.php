<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $this->authorize('browse_customers');

        return view('admin.pages.customers.index');
    }

    public function create(): View
    {
        $this->authorize('add_customers');

        return view('admin.pages.customers.create');
    }

    public function show(int $id): View
    {
        $this->authorize('read_customers');

        return view('admin.pages.customers.show', [
            'customer' => (new UserRepository())->with(['addresses', 'orders'])->getById($id),
        ]);
    }
}
