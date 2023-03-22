<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class AdminLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.admin-layout', [
            'menu' => $this->buildAdminMenu()
        ]);
    }

    private function buildAdminMenu(): array
    {
        $menu = [
            [
                'id' => 'catalog',
                'title' => 'Catalog',
                'icon' => '<path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>',
                'url' => route('admin.catalog.index'),
                'active' => false,
                'items' => [
                    [
                        'id' => 'catalog.index',
                        'title' => 'Catalog',
                        'url' => route('admin.catalog.index'),
                        'active' => false
                    ],
                    [
                        'id' => 'catalog.products.index',
                        'title' => 'Products',
                        'url' => route('admin.catalog.products.index'),
                        'active' => false
                    ],
                    [
                        'id' => 'catalog.sections.index',
                        'title' => 'Sections',
                        'url' => route('admin.catalog.sections.index'),
                        'active' => false
                    ],
                    [
                        'id' => 'catalog.properties.index',
                        'title' => 'Properties',
                        'url' => route('admin.catalog.properties.index'),
                        'active' => false
                    ],
                ]
            ],
            [
                'id' => 'sale',
                'title' => 'Sale',
                'icon' => '<path clip-rule="evenodd" fill-rule="evenodd" d="M.99 5.24A2.25 2.25 0 013.25 3h13.5A2.25 2.25 0 0119 5.25l.01 9.5A2.25 2.25 0 0116.76 17H3.26A2.267 2.267 0 011 14.74l-.01-9.5zm8.26 9.52v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.615c0 .414.336.75.75.75h5.373a.75.75 0 00.627-.74zm1.5 0a.75.75 0 00.627.74h5.373a.75.75 0 00.75-.75v-.615a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625zm6.75-3.63v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75zM17.5 7.5v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75z"></path>',
                'url' => '',
                'active' => false,
                'items' => [
                    [
                        'id' => 'sale.index',
                        'title' => 'Catalog',
                        'url' => '',
                        'active' => false
                    ],
                    [
                        'id' => 'sale.products.index',
                        'title' => 'Products',
                        'url' => '',
                        'active' => false
                    ],
                    [
                        'id' => 'sale.sections.index',
                        'title' => 'Sections',
                        'url' => '',
                        'active' => false
                    ],
                    [
                        'id' => 'sale.properties.index',
                        'title' => 'Properties',
                        'url' => '',
                        'active' => false
                    ],
                ]
            ]
        ];

        $currentUrl = Request::url();
        foreach ($menu as $k => $menuSection) {
            if (Str::startsWith($currentUrl, $menuSection['url'])) {
                $menu[$k]['active'] = true;
            }
            foreach ($menuSection['items'] as $ck => $childItem) {
                if (Str::startsWith($currentUrl, $childItem['url'])) {
                    $menu[$k]['items'][$ck]['active'] = true;
                    $menu[$k]['active'] = true;
                }
            }
        }

        return $menu;
    }
}
