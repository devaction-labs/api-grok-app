<?php

namespace App\Http\Controllers\Customer;

use App\Enum\Authorize\PermissionsEnum;
use App\Exceptions\Authorize\AuthorizationException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\CustomerCollection;
use App\Models\Customer;
use App\Services\Authorize\AuthorizeAccount;
use DevactionLabs\FilterablePackage\Filter;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): CustomerCollection
    {
        AuthorizeAccount::authorize(PermissionsEnum::VIEW_CUSTOMERS);

        $customers = Customer::query()
            ->filtrable([
                Filter::like('name', 'name'),
                Filter::exact('email', 'email'),
                Filter::exact('phone', 'phone'),
                Filter::gt('created_at', 'created_at'),
                Filter::lt('created_at', 'created_at'),
            ])
            ->customPaginate();

        return new CustomerCollection($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
