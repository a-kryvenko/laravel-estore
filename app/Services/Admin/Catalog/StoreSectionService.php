<?php

namespace App\Services\Admin\Catalog;

use App\Http\Requests\Estore\Admin\Catalog\StoreSectionRequest;
use App\Http\Requests\Estore\Admin\Catalog\UpdateSectionRequest;
use App\Models\Estore\Catalog\Section;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreSectionService
{
    /**
     * @param StoreSectionRequest $request
     * @return Section
     * @throws Exception
     */
    public function store(StoreSectionRequest $request): Section
    {
        try {
            DB::beginTransaction();
            $section = Section::create($request->validated());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $section;
    }

    /**
     * @param Section $section
     * @param UpdateSectionRequest $request
     * @return void
     * @throws Exception
     */
    public function update(Section $section, UpdateSectionRequest $request)
    {
        try {
            DB::beginTransaction();
            $section->update($request->validated());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param Section $section
     * @return void
     * @throws Exception
     */
    public function delete(Section $section): void
    {
        try {
            DB::beginTransaction();
            $section->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
