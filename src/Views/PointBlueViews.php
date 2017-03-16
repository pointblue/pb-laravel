<?php

namespace PointBlue\Laravel\Views;

use Illuminate\Console\Command;

class PointBlueViews extends Command
{
    const VIEWS_DEST_PATH = '/../../../../../resources/views/';
    const PARTIALS_DEST_PATH = 'partials/';
    const UNIVERSAL_PARTIALS_DEST_PATH = 'universal/';
    const FOOTER_BLADE_DEST_FILENAME = 'pb-footer.blade.php';
    const NAVBAR_BLADE_DEST_FILENAME = 'pb-navbar.blade.php';
    const LOADING_BLADE_DEST_FILENAME = 'pb-loading.blade.php';

    const BLADES_PATH = '/blades/';
    const FOOTER_BLADE_FILENAME = 'pb-footer.blade.php';
    const NAVBAR_BLADE_FILENAME = 'pb-navbar.blade.php';
    const LOADING_BLADE_FILENAME = 'pb-loading.blade.php';
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
        $viewDestPath = __DIR__ . self::VIEWS_DEST_PATH . self::PARTIALS_DEST_PATH . self::UNIVERSAL_PARTIALS_DEST_PATH;
        $viewSourcePath = __DIR__ . self::BLADES_PATH;
        self::makeDirectory($viewDestPath);

        switch ($viewName){
            case 'footer':
                $filename = self::FOOTER_BLADE_FILENAME;
                $filenameDest = self::FOOTER_BLADE_DEST_FILENAME;
                break;
            case 'navbar':
                $filename = self::NAVBAR_BLADE_FILENAME;
                $filenameDest = self::NAVBAR_BLADE_DEST_FILENAME;

                $bespokeFile = 'currentProject.blade.php';
                $bespokeSource = $viewSourcePath . $bespokeFile;
                $bespokeDestination = viewDestPath . "/../". $bespokeFile;
                self::copyFile($bespokeSource, $bespokeDestination);

                break;
            case 'loading':
                $filename = self::LOADING_BLADE_FILENAME;
                $filenameDest = self::LOADING_BLADE_DEST_FILENAME;
                break;
        }

        $viewBladeFilePath = $viewSourcePath . $filename;
        self::copyFile($viewBladeFilePath,$viewDestPath.$filenameDest);
    }

    private function makeDirectory($viewDestPath)
    {
        if(!is_dir($viewDestPath)){
            //Directory does not exist, so lets create it.
            mkdir($viewDestPath, 0775, true);
        }
    }

    private function copyFile($source, $destination)
    {
        $viewContents = file_get_contents($source);
        file_put_contents($destination, $viewContents);
    }
}
