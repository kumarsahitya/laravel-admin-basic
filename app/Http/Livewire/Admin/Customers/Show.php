<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Http\Livewire\Admin\AbstractBaseComponent;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Show extends AbstractBaseComponent
{
    public Model $customer;

    public int $user_id;

    public string $last_name;

    public string $first_name;

    public string $email;

    public string $picture;

    protected $listeners = ['profileUpdate'];

    public function mount(Model $customer): void
    {
        $this->customer = $customer->load('addresses');
        $this->user_id = $customer->id;
        $this->email = $customer->email;
        $this->last_name = $customer->last_name;
        $this->first_name = $customer->first_name;
        $this->picture = $customer->picture;
    }

    public function profileUpdate(): void
    {
        $this->email = $this->customer->email;
        $this->last_name = $this->customer->last_name;
        $this->first_name = $this->customer->first_name;
        $this->picture = $this->customer->picture;
    }

    public function store(): void
    {
        $this->validate($this->rules());

        (new UserRepository())->getById($this->customer->id)->update([
            'email' => $this->email,
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
        ]);

        session()->flash('success', __('Customer successfully updated!'));

        $this->redirectroute('admin.customers.index');
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'max:150',
                Rule::unique('users', 'email')->ignore($this->user_id),
            ],
            'last_name' => 'sometimes|required',
            'first_name' => 'sometimes|required',
        ];
    }

    public function render(): View
    {
        return view('admin.livewire.customers.show');
    }
}
