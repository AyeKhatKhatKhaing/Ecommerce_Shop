<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassificationFormRequest;
use App\Interfaces\Repositories\ClassificationRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class ClassificationController extends Controller
{
    use AdminRolePermission;

    private ClassificationRepositoryInterface $classificationRepository;

    public function __construct(ClassificationRepositoryInterface $classificationRepository)
    {
        $this->classificationRepository = $classificationRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->classificationRepository->getAllClassificationList($request);

        return view('admin.classification.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.classification.create');
    }

    public function store(ClassificationFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->classificationRepository->saveClassificationData($request);

        return redirect('admin/classification')->with('flash_message', 'Classification added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $classification = $this->classificationRepository->getClassificationData($id);

        return view('admin.classification.edit', compact('classification'));
    }

    public function update(ClassificationFormRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->classificationRepository->saveClassificationData($request, $id);

        return redirect('admin/classification')->with('flash_message', 'Classification updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->classificationRepository->deleteClassification($id);

        return redirect('admin/classification')->with('flash_message', 'Classification deleted!');
    }

    public function statusChange(Request $request)
    {
        $classification = $this->classificationRepository->classificationStatusChange($request);

        return response()->json([
            "success"   => true,
            'isPublish' => $classification->status,
            'id'        => $classification->id,
        ]);

    }
}
