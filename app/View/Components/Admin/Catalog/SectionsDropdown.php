<?php

namespace App\View\Components\Admin\Catalog;

use App\Models\Estore\Catalog\Section;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SectionsDropdown extends Component
{
    private ?int $currentSectionId;
    private ?array $onlySections;

    private array $options = [];

    /**
     * Create a new component instance.
     */
    public function __construct(?int $currentSectionId = null, ?array $only = null)
    {
        $this->currentSectionId = $currentSectionId;
        $this->onlySections = $this->getSectionsWithParents($only);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $sections = Section::orderBy('name')
            ->where('parent_section_id', false)
            ->where('id', '!=', $this->currentSectionId)
            ->with(['sections', 'parent'])
            ->get();

        $this->options[0] = '.';

        foreach ($sections as $section) {
            $this->setOption($section);
        }

        return view('components.admin.catalog.sections-dropdown', [
            'options' => $this->options
        ]);
    }

    private function setOption(Section $section, int $depth = 1): void
    {
        $prefix = '';
        for ($i = 0; $i < $depth; $i ++) {
            $prefix .= '&#183; ';
        }

        $this->options[$section->id] = $prefix . $section->name;

        if (!empty($section->sections)) {
            $depth ++;
            foreach ($section->sections as $childSection) {
                if ($this->skipSection($childSection->id)) {
                    continue;
                }
                $this->setOption($childSection, $depth);
            }
        }
    }

    private function getSectionsWithParents(?array $ids = null): ?array
    {
        if (is_null($ids)) {
            return null;
        }

        $all = [];

        $sections = Section::whereIn('id', $ids)->with(['parent'])->get();
        foreach ($sections as $section) {
            $all[] = $section->id;
            $parent = $section->parent;
            while ($parent) {
                $all[] = $parent->id;
                $parent = $parent->parent;
            }
        }

        return array_unique($all);
    }

    private function skipSection(int $id): bool
    {
        if (is_array($this->onlySections) && !in_array($id, $this->onlySections)) {
            return true;
        }
        if ($id == $this->currentSectionId) {
            return true;
        }
        return false;
    }
}
