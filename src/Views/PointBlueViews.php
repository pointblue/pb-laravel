<?php

namespace PointBlue\Laravel\Views;

use Illuminate\Console\Command;

class PointBlueViews extends Command
{
	const VIEWS_DEST_PATH = '/../../../../../resources/views/';
	const PARTIALS_DEST_PATH = 'partials/';
	const UNIVERSAL_PARTIALS_DEST_PATH = 'universal/';
	const FOOTER_BLADE_DEST_FILENAME = 'pb-footer.blade.php';

	const BLADES_PATH = '/blades/';
	const FOOTER_BLADE_FILENAME = 'pb-footer.blade.php';
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

	    if($viewName == 'footer')
	    {
		    $this->installFooter();
	    }
    }

    private function installFooter()
    {
	    $footerDestPath = __DIR__ . self::VIEWS_DEST_PATH . self::PARTIALS_DEST_PATH . self::UNIVERSAL_PARTIALS_DEST_PATH;
	    $footerBladeFilePath = __DIR__ . self::BLADES_PATH . self::FOOTER_BLADE_FILENAME;
	    mkdir($footerDestPath, 0775);
	    $footerContents = file_get_contents($footerBladeFilePath);
	    file_put_contents($footerDestPath . self::FOOTER_BLADE_DEST_FILENAME, $footerContents);
    }
}
