<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Interfaces\Repositories\CountryRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    use AdminRolePermission;

    private CountryRepositoryInterface $countryReporitory;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->countryRepository->getAllCountryList($request);

        return view('admin.country.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.country.create');
    }

    public function store(CountryRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->countryRepository->saveCountryData($request);

        return redirect('admin/countries')->with('flash_message', 'Country added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $country = $this->countryRepository->getCountryData($id);

        return view('admin.country.edit', compact('country'));
    }

    public function update(CountryRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->countryRepository->saveCountryData($request, $id);

        return redirect('admin/countries')->with('flash_message', 'Country updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->countryRepository->deleteCountry($id);

        return redirect('admin/countries')->with('flash_message', 'Country deleted!');
    }

    public function statusChange(Request $request)
    {
        $country = $this->countryRepository->countryStatusChange($request);

        return response()->json([
            'success'   => true,
            'isPublish' => $country->status,
            'id'        => $country->id,
        ]);
    }
}
