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

namespace MicroweberPackages\Multilanguage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use MicroweberPackages\Form\FormElementBuilder;
use MicroweberPackages\Module\Module;
use MicroweberPackages\Multilanguage\Repositories\MultilanguageRepository;


class MultilanguageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function register()
    {


        $this->loadMigrationsFrom(__DIR__ . '/migrations/');
    }
    public function boot(){

        if (!mw_is_installed()) {
            return;
        }

        $isMultilanguageActive = false;

        if (is_module('multilanguage') && get_option('is_active', 'multilanguage_settings') == 'y') {
            $isMultilanguageActive = true;
        }

       /* $getModule = DB::table('modules')->where('module', '=','multilanguage')->where('installed',1)->count();
        $getOption = DB::table('options')
            ->where('option_group', 'multilanguage_settings')
            ->where('option_key','is_active')
            ->where('option_value', 'y')
            ->count();
        if ($getModule && $getOption) {
            $isMultilanguageActive = true;
        }*/

        if (defined('MW_DISABLE_MULTILANGUAGE')) {
            $isMultilanguageActive = false;
        }

        MultilanguageHelpers::setMultilanguageEnabled($isMultilanguageActive);

        $this->app->bind('multilanguage_repository', function () {
            return new MultilanguageRepository();
        });

        if ($isMultilanguageActive) {
            // $this->app->register(MultilanguageEventServiceProvider::class);
            $this->app->bind(FormElementBuilder::class, function ($app) {
                return new MultilanguageFormElementBuilder();
            });
        }
    }

}
