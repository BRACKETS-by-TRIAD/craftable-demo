<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Export\DestroyExport;
use App\Http\Requests\Admin\Export\IndexExport;
use App\Http\Requests\Admin\Export\StoreExport;
use App\Http\Requests\Admin\Export\UpdateExport;
use App\Models\Export;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class ExportsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexExport $request
     * @return Response|array
     */
    public function index(IndexExport $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Export::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'title', 'published_at', 'enabled'],

            // set columns to searchIn
            ['id', 'title', 'perex']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('admin.export.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin.export.create');

        return view('admin.export.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExport $request
     * @return Response|array
     */
    public function store(StoreExport $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Export
        $export = Export::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/exports'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/exports');
    }

    /**
     * Display the specified resource.
     *
     * @param Export $export
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return void
     */
    public function show(Export $export)
    {
        $this->authorize('admin.export.show', $export);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Export $export
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return Response
     */
    public function edit(Export $export)
    {
        $this->authorize('admin.export.edit', $export);

        return view('admin.export.edit', [
            'export' => $export,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExport $request
     * @param Export $export
     * @return Response|array
     */
    public function update(UpdateExport $request, Export $export)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Update changed values Export
        $export->update($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/exports'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/exports');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyExport $request
     * @param Export $export
     * @throws \Exception
     * @return Response|bool
     */
    public function destroy(DestroyExport $request, Export $export)
    {
        $export->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Export entities
     */
    public function export()
    {
        return Excel::download(new ExportsExport, 'exports.xlsx');
    }
}
