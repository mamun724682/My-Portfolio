<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeRequest;
use App\Models\Code;
use App\Services\CodeService;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    protected $codeService;
    public function __construct(CodeService $codeService)
    {
        $this->codeService = $codeService;
    }

    public function store(CodeRequest $request)
    {
        try {
            $this->codeService->updateOrCreate($request->validated());
            sendFlash('Code sample added.');
            return back();
        } catch (\Exception $e) {
            sendFlash($e->getMessage(), 'error');
            return back()->withInput();
        }
    }

    public function edit(Code $code)
    {
        setPageMeta('Edit Code Sample');
        return view('codes.edit', compact('code'));
    }

    public function update(CodeRequest $request, $id)
    {
        try {
            $this->codeService->updateOrCreate($request->validated(), $id);
            sendFlash('Code sample updated.');
            return back();
        } catch (\Exception $e) {
            sendFlash($e->getMessage(), 'error');
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->codeService->delete($id);
            sendFlash('Code sample deleted.');
            return back();
        } catch (\Exception $e) {
            sendFlash($e->getMessage(), 'error');
            return back();
        }
    }
}
