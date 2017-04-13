<?php

namespace PointBlue\Laravel\Views;

use Illuminate\Console\Command;

class PointBlueViews extends Command
{
    const BLADES_PATH = '/blades/';
	const UNIVERSALS_PATH = 'views/partials/universal/';

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
        $viewDestPath = resource_path(self::UNIVERSALS_PATH);
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
	    self::commonInstall(self::UNIVERSALS_PATH . 'pb-footer.blade.php');
	    self::install_release();
	    self::install_docs();
    }

    private static function install_navbar()
    {
	    self::commonInstall(self::UNIVERSALS_PATH . 'pb-navbar.blade.php');
	    self::commonInstall(self::UNIVERSALS_PATH . 'currentProject.blade.php');
    }

    private static function install_loading()
    {
	    self::commonInstall(self::UNIVERSALS_PATH . 'pb-loading.blade.php');
    }

    private static function install_docs()
    {
	    self::commonInstall('views/pb-docs.blade.php');
    }

    private static function install_release()
    {
	    self::commonInstall('views/pb-release.blade.php');
    }
    private static function install_feedback()
    {
		self::commonInstall(self::UNIVERSALS_PATH . 'pb-feedback.blade.php');
    }

	/**
	 * @param $templateFilePath String Relative to: __DIR__ . self::BLADES_PATH
	 */
    private static function commonInstall($templateFilePath)
    {
	    $viewSourcePath = __DIR__ . self::BLADES_PATH . $templateFilePath;
	    $viewDestinationPath = resource_path( $templateFilePath );
	    self::copyFile($viewSourcePath, $viewDestinationPath);
    }

}
