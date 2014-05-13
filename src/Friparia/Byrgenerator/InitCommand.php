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
            $this->info('Creating Init ...');
            if($this->init()){
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

    protected function init(){
        $generation = array(
            // array('user', 'migration'),
            // array('user', 'model'),
            // array('role', 'model'),
            // array('permission', 'model'),
            // array('user', 'controller'),
            // array('master', 'view'),
            // array('user.login', 'view'),
            array('user.index', 'view'),
            array('permission.index', 'view'),
            array('role.index', 'view'),
            array('', 'routes'),
        );
        foreach($generation as $value)
        {
            if(!$this->generateFile($value[0], $value[1])){
                return false;
            }
        }
        // $this->call('asset:publish', array('--bench'=>'friparia/byrgenerator'));
        // $this->info("You should move assets into root directory");
        return true;
    }

    protected function generateFile($name, $type){
        $this->line('');
        $this->info('init '.$name.' '.$type.' ...');
        if(!in_array($type,array('view','routes'))){
            $output = with(app())['view']->make('byrgenerator::generators.init_'.$name.'_'.$type);
        }
        switch($type){
            case "migration":
                $path = $this->laravel->path."/database/migrations/".date('Y_m_d_His')."_init_".$name."_table.php";
                break;
            case "model":
                $path = $this->laravel->path."/models/".ucfirst($name).".php";
                break;
            case "controller":
                $path = $this->laravel->path."/controllers/".ucfirst($name)."Controller.php";
                break;
            case "routes":
                $path = $this->laravel->path."/routes.php";
                $output = with(app())['view']->make('byrgenerator::generators.init_routes');
                break;
            case "view":
                $src = explode('.', $name);
                $name = array_pop($src);
                $folder = implode('/', $src);
                if(!empty($folder) && !file_exists($this->laravel->path."/views/".$folder)){
                    mkdir($this->laravel->path."/views/".$folder, 0755);
                }

                $path = $this->laravel->path."/views/".$folder."/".$name.".blade.php";
                $name = 'init_'.$name;
                array_push($src, $name);
                $output = with(app())['view']->make('byrgenerator::generators.'.implode('.', $src).'_view');
                break;
            default:
                $this->error('You need enter an type like controller or model or route');
                return false;
        }
        if($type != 'routes'){
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
            $this->info('success init '.$name.' '.$type.' ...');
        }else{
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
            $this->info('success init '.$name.' '.$type.' ...');
        }
        if($type == 'migration')
        {
            $this->call('migrate');
        }
        return true;
    }
}
