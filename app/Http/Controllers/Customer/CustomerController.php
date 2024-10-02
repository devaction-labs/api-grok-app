<?php

namespace App\Http\Controllers\Customer;

use App\Enum\Authorize\PermissionsEnum;
use App\Exceptions\Authorize\AuthorizationException;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\{CustomerStoreRequest, CustomerUpdateRequest};
use App\Http\Resources\Customer\{CustomerCollection, CustomerResource};
use App\Models\Customer;
use App\Services\Authorize\AuthorizeAccount;
use DevactionLabs\FilterablePackage\Filter;
use Illuminate\Http\{JsonResponse};
use Symfony\Component\HttpFoundation\Response;

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
     * List all customers.
     *
     * Store a newly created resource in storage.
     * @throws AuthorizationException
     */
    public function store(CustomerStoreRequest $request): JsonResponse
    {
        AuthorizeAccount::authorize(PermissionsEnum::CREATE_CUSTOMERS);

        $data = $request->validated();

        Customer::query()->create($data);

        return ResponseHelper::created();
    }

    /**
     * Show the customer.
     *
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(Customer $id): CustomerResource
    {
        AuthorizeAccount::authorize(PermissionsEnum::VIEW_CUSTOMERS);

        return new CustomerResource($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(CustomerUpdateRequest $request, Customer $customer): JsonResponse
    {
        AuthorizeAccount::authorize(PermissionsEnum::EDIT_CUSTOMERS);

        $data = $request->validated();

        $customer->update($data);

        return ResponseHelper::updated();
    }

    /**
     * Remove the specified resource from storage.
     *
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(Customer $id): Response
    {
        AuthorizeAccount::authorize(PermissionsEnum::DELETE_CUSTOMERS);

        $id->delete();

        return ResponseHelper::deleted();
    }
}
