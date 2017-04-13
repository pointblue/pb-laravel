<?php

namespace PointBlue\Laravel\Views;

use Illuminate\Console\Command;

class PointBlueViews extends Command
{
    const BLADES_PATH = '/blades/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pb:view {viewname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Point Blue blade template';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $viewName = $this->argument('viewname');

        $this->installView($viewName);
    }

    private function installView($viewName)
    {
        $viewDestPath = resource_path('views/partials/universal/');
        self::makeDirectory($viewDestPath);

        /*
         * To add a new view, create a new function named "install_{viewname}"
         * based off of examples below.  When the view gets installed, that
         * function will be run.
         */
        $handlerFn = 'install_'.$viewName;
        if (is_callable(self::$handlerFn()) ){
            call_user_func(self::$handlerFn());
        }
    }

    private static function makeDirectory($dirPath)
    {
        if(!is_dir($dirPath)){
            //Directory does not exist, so lets create it.
            mkdir($dirPath, 0775, true);
        }
    }

    private static function copyFile($source, $destination)
    {
        $viewContents = file_get_contents($source);
        file_put_contents($destination, $viewContents);
    }


    private static function install_footer()
    {
        $filename = 'pb-footer.blade.php';
        $viewSourcePath = __DIR__ . self::BLADES_PATH . $filename;
        $viewDestinationPath = resource_path('views/partials/universal/'.$filename);
        self::copyFile($viewSourcePath, $viewDestinationPath);
    }

    private static function install_navbar()
    {
        $filename = 'pb-navbar.blade.php';
        $viewSourcePath = __DIR__ . self::BLADES_PATH . $filename;
        $viewDestinationPath = resource_path('views/partials/universal/'.$filename);
        self::copyFile($viewSourcePath, $viewDestinationPath);

        $bespokeFile = 'currentProject.blade.php';
        $bespokeSource =  __DIR__ . self::BLADES_PATH . $bespokeFile;
        $bespokeDestination = resource_path('views/partials/'.$bespokeFile);
        self::copyFile($bespokeSource, $bespokeDestination);
    }

    private static function install_loading()
    {
        $filename = 'pb-navbar.blade.php';
        $viewSourcePath = __DIR__ . self::BLADES_PATH . $filename;
        $viewDestinationPath = resource_path('views/partials/universal/'.$filename);
        self::copyFile($viewSourcePath, $viewDestinationPath);
    }

    private static function install_docs()
    {
        $filename = 'pb-docs.blade.php';
        $viewSourcePath = __DIR__ . self::BLADES_PATH . $filename;
        $viewDestinationPath = resource_path('views/'.$filename);
        self::copyFile($viewSourcePath, $viewDestinationPath);
    }

    private static function install_release()
    {
        $filename = 'pb-release.blade.php';
        $viewSourcePath = __DIR__ . self::BLADES_PATH . $filename;
        $viewDestinationPath = resource_path('views/'.$filename);
        self::copyFile($viewSourcePath, $viewDestinationPath);
    }
}
