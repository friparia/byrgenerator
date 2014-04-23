<?php namespace Friparia\Byrgenerator;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'byrgenerator:generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

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
	public function fire()
	{
        if($this->confirm('Generate?[Yes|no]')){
            $this->line('');
            if($this->generate()){
                $this->info('generated');
            }
            else{
                $this->error('error happens');
            }
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	// protected function getArguments()
	// {
	// 	return array(
	// 		array('example', InputArgument::REQUIRED, 'An example argument.'),
	// 	);
	// }

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	// protected function getOptions()
	// {
	// 	return array(
	// 		array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
    // 	);
	// }

    protected function generate(){
        if(!$this->generateController('project')){
            return false;
        }
        if(!$this->generateView('project')){
            return false;
        }
        if(!$this->generateRoute('project')){
            return false;
        }
        return true;
    }
    
    protected function generateController($name){
        $this->line('');
        $this->info('generate controller');
        $path = $this->laravel->path."/controllers/".ucfirst($name)."Controller.php";
        $output = with(app())['view']->make("byrgenerator::generators.template_controller", array(
            'classname' => ucfirst($name),
            'name' => $name,
            'attributes' => $this->getOwnAttributes($name)
        ));

        if( !file_exists( $path ) )
        {
            $fs = fopen($path, 'x');
            if ( $fs )
            {
                fwrite($fs, $output);
                fclose($fs);
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
        $this->info('success generate '.ucfirst($name).' Controller...');
        return true;
    }

    protected function generateModel(){
    }

    protected function generateView($name){
        $this->line('');
        $this->info('generate view');
        $path = $this->laravel->path."/views/".$name."/index.blade.php";
        $output = with(app())['view']->make("byrgenerator::generators.template_view", array(
            'name' => $name,
            'classname' => ucfirst($name),
            'description' => $this->getOwnDescription($name),
            'attributes' => $this->getOwnAttributes($name),
        ));

        mkdir($this->laravel->path."/views/".$name, 0755);
        if( !file_exists( $path ) )
        {
            $fs = fopen($path, 'x');
            if ( $fs )
            {
                fwrite($fs, $output);
                fclose($fs);
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
        $this->info('success generate '.ucfirst($name).' View...');
        return true;
    }

    protected function generateRoute($name){
        $this->line('');
        $this->info('generate route');
        $path = $this->laravel->path."/routes.php";
        $output = with(app())['view']->make("byrgenerator::generators.template_route", array(
            'name' => $name,
            'classname' => ucfirst($name),
            ));
        if( file_exists( $path ) )
        {
            $fs = fopen($path, 'a');
            if ( $fs )
            {
                fwrite($fs, $output);
                fclose($fs);
                // return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
        $this->info('success generate '.$name.' route ...');
        return true;
    }


    protected function getOwnAttributes($name){
        return with(app())['config']->get("byrgenerator::resource.attributes");
    }

    protected function getOwnDescription($name){
        return with(app())['config']->get("byrgenerator::resource.description");
    }
}
