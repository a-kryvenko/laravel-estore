<?php

namespace App\View\Components\Admin\Catalog;

use App\Models\Estore\Catalog\Section;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SectionsDropdown extends Component
{
    private ?int $currentSectionId;

    private array $options = [];

    /**
     * Create a new component instance.
     */
    public function __construct(?int $currentSectionId = null)
    {
        $this->currentSectionId = $currentSectionId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $sections = Section::orderBy('name')
            ->where('parent_section_id', null)
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
                if ($childSection->id == $this->currentSectionId) {
                    continue;
                }
                $this->setOption($childSection, $depth);
            }
        }
    }
}
