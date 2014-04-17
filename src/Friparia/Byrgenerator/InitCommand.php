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
        // $migration_file = $this->laravel->path."/database/migrations/".date('Y_m_d_His')."_init_table.php";
        // $output =  with(app())['view']->make('byrgenerator::generators.init_table');
        // if( ! file_exists( $migration_file ) )
        // {
        //     $fs = fopen($migration_file, 'x');
        //     if ( $fs )
        //     {
        //         fwrite($fs, $output);
        //         fclose($fs);
        //         // return true;
        //     }
        //     else
        //     {
        //         return false;
        //     }
        // }
        // else
        // {
        //     return false;
        // }
        // $this->call('migrate');
        return true;
    }
}
