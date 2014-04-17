<?php namespace Friparia\Byrgenerator;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InitCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'byrgenerator:init';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Init the tables and user pages';

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
        if($this->confirm('Run Init?[Yes|no]')){
            $this->line('');
            $this->info('Creating Init...');
            if($this->doInit()){
                $this->info('init created');
            }else{
                $this->error('error happens');
            }
        }
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

    protected function doInit(){
        $this->line('');
        $this->info('init migrate');
        $migration_file = $this->laravel->path."/database/migrations/".date('Y_m_d_His')."_init_table.php";
        $output =  with(app())['view']->make('byrgenerator::generators.init_table');
        if( ! file_exists( $migration_file ) )
        {
            $fs = fopen($migration_file, 'x');
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
        $this->call('migrate');
        $this->info('init model');
        $user_model_file =  $this->laravel->path."/models/User.php";
        $output = with(app())['view']->make('byrgenerator::generators.init_user_model');
        if( ! file_exists( $user_model_file ) )
        {
            $fs = fopen($user_model_file, 'x');
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
        $this->info('init controller');
        $user_controller_file =  $this->laravel->path."/controllers/UserController.php";
        $output = with(app())['view']->make('byrgenerator::generators.init_user_controller');
        if( ! file_exists( $user_controller_file ) )
        {
            $fs = fopen($user_controller_file, 'x');
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
        $this->info('init routes');
        $route_file =  $this->laravel->path."/routes.php";
        $output = with(app())['view']->make('byrgenerator::generators.init_routes');
        if( file_exists( $route_file ) )
        {
            $fs = fopen($route_file, 'a');
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
        $this->call('asset:publish', array('--bench' => 'friparia/byrgenerator'));
        return true;
    }
}
