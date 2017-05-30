<?php

namespace PointBlue\Laravel\Views;

use Illuminate\Console\Command;

class PointBlueViews extends Command
{
    // source paths
	const BLADES_PATH = '/blades/';
	const STYLESHEETS_PATH = '/sass/';

	// destination paths
    const SASS_ASSETS_PATH = 'assets/sass/';
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
		self::commonInstall(self::UNIVERSALS_PATH, 'pb-footer.blade.php');
		self::install_release();
		self::install_docs();
        self::install_stylesheets();
	}

	private static function install_navbar()
	{
		self::commonInstall(self::UNIVERSALS_PATH, 'pb-navbar.blade.php');
		self::commonInstall(self::UNIVERSALS_PATH, 'currentProject.blade.php');
        self::install_stylesheets();

	}

	private static function install_loading()
	{
		self::commonInstall(self::UNIVERSALS_PATH, 'pb-loading.blade.php');
	}

	private static function install_docs()
	{
		self::commonInstall('views/', 'pb-docs.blade.php');
	}

	private static function install_release()
	{
		self::commonInstall('views/', 'pb-release.blade.php');
	}
	private static function install_feedback()
	{
		self::commonInstall(self::UNIVERSALS_PATH, 'pb-feedback.blade.php');
	}
    private static function install_stylesheets()
    {
        $stylesheetFilePath = resource_path(self::SASS_ASSETS_PATH . 'app.scss');
        if(!is_file($stylesheetFilePath)){
            self::commonInstall(self::SASS_ASSETS_PATH, 'app.scss', 'stylesheet');
        }
    }

	/**
	 * @param $destinationFilePath String
	 * @param $fileName String
	 * @param $assetType String
	 */
	private static function commonInstall($destinationFilePath, $fileName, $assetType = 'blade')
	{
	    if($assetType === 'stylesheet'){
	        $sourcePath = __DIR__ . self::STYLESHEETS_PATH . $fileName;
        } else {
            $sourcePath = __DIR__ . self::BLADES_PATH . $fileName;
        }

		$destinationPath = resource_path( $destinationFilePath . $fileName );
		self::copyFile($sourcePath, $destinationPath);
	}

}
