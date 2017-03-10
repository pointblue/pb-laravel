<?php

namespace PointBlue\Laravel\Views;

use Illuminate\Console\Command;

class PointBlueViews extends Command
{
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
	    $footerContents = file_get_contents(__DIR__ . 'blades/pb-footer.php');
	    file_put_contents(__DIR__ . '../../../resources/views/pb-footer.php', $footerContents);
    }
}
