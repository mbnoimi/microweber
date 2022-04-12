<?php
/*
 * This file is part of the Microweber framework.
 *
 * (c) Microweber CMS LTD
 *
 * For full license information see
 * https://github.com/microweber/microweber/blob/master/LICENSE
 *
 */

namespace MicroweberPackages\Modules\Admin\ImportExportTool;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use MicroweberPackages\Modules\Admin\ImportExportTool\Http\Livewire\Counter;

class ImportExportToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::component('counter', Counter::class);

        View::addNamespace('import_export_tool', normalize_path((__DIR__) . '/resources/views'));
    }

    public function register()
    {
        $this->loadRoutesFrom((__DIR__) . '/routes/admin.php');
    }
}