<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CrudCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'make:crud';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new set of routes, functions, and views for an AJAX CRUD implementation';

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
		$controllerPrefix = $this->option('controllerPrefix');
		$crudModel = $this->option('crudModel');
		
		if (empty($controllerPrefix)) {
			$this->error('The Controller prefix is required');
			return;
		}
		
		if (empty($crudModel)) {
			$this->error('The CRUD model is required');
			return;
		}
		
		$this->info('Attempting to generate ' . $crudModel . ' CRUD');
		
		$lowerControllerPrefix = strtolower($controllerPrefix);
		$lowerCrudModel = strtolower($crudModel);
		
		$url = '/'.$lowerControllerPrefix . '/crud/' . $lowerCrudModel;
		
		$controller = $controllerPrefix . 'Controller';
		
		/* Routes */
		$routes = \Storage::disk('local')->get('crudStubs/routes.stub');
		$routes = str_replace('{{url}}', $url, $routes);
		$routes = str_replace('{{controller}}', $controller, $routes);
		$routes = str_replace('{{crudModel}}', $crudModel, $routes);
		$routes = str_replace('{{lowerCrudModel}}', $lowerCrudModel, $routes);
		$routes = str_replace('{{lowerControllerPrefix}}', $lowerControllerPrefix, $routes);
		\Storage::disk('local')->put('crudPartial/'.$lowerControllerPrefix . $crudModel . '/routes.stub', $routes);
		
		/* Controller */
		$controller = \Storage::disk('local')->get('crudStubs/controllers/controller.stub');
		$controller = str_replace('{{crudModel}}', $crudModel, $controller);
		$controller = str_replace('{{lowerCrudModel}}', $lowerCrudModel, $controller);
		$controller = str_replace('{{lowerControllerPrefix}}', $lowerControllerPrefix, $controller);
		\Storage::disk('local')->put('crudPartial/'.$lowerControllerPrefix . $crudModel . '/controllers/controller.stub', $controller);
		
		/* Views */
		// Rows View
		$rows = \Storage::disk('local')->get('crudStubs/views/crud/rows.stub');
		$rows = str_replace('{{crudModel}}', $crudModel, $rows);
		$rows = str_replace('{{lowerCrudModel}}', $lowerCrudModel, $rows);
		\Storage::disk('local')->put('crudPartial/'.$lowerControllerPrefix . $crudModel . '/views/crud/rows.stub', $rows);
		
		// Edit Rows View
		$editRows = \Storage::disk('local')->get('crudStubs/views/crud/edit_rows.stub');
		$editRows = str_replace('{{crudModel}}', $crudModel, $editRows);
		$editRows = str_replace('{{lowerCrudModel}}', $lowerCrudModel, $editRows);
		\Storage::disk('local')->put('crudPartial/'.$lowerControllerPrefix . $crudModel . '/views/crud/edit_rows.stub', $editRows);
		
		// New Row View
		$newRow = \Storage::disk('local')->get('crudStubs/views/crud/new_row.stub');
		$newRow = str_replace('{{crudModel}}', $crudModel, $newRow);
		$newRow = str_replace('{{lowerCrudModel}}', $lowerCrudModel, $newRow);
		\Storage::disk('local')->put('crudPartial/'.$lowerControllerPrefix . $crudModel . '/views/crud/new_row.stub', $newRow);
		
		// Modal View
		$modalView = \Storage::disk('local')->get('crudStubs/views/crud/modal.stub');
		$modalView = str_replace('{{crudModel}}', $crudModel, $modalView);
		$modalView = str_replace('{{lowerCrudModel}}', $lowerCrudModel, $modalView);
		\Storage::disk('local')->put('crudPartial/'.$lowerControllerPrefix . $crudModel . '/views/crud/new_modal.stub', $modalView);
		
		// Modal Edit View
		$modalEditView = \Storage::disk('local')->get('crudStubs/views/crud/modalEdit.stub');
		$modalEditView = str_replace('{{crudModel}}', $crudModel, $modalView);
		$modalEditView = str_replace('{{lowerCrudModel}}', $lowerCrudModel, $modalView);
		\Storage::disk('local')->put('crudPartial/'.$lowerControllerPrefix . $crudModel . '/views/crud/edit_modal.stub', $modalEditView);
		
		// Modify
		$modify = \Storage::disk('local')->get('crudStubs/views/modify.stub');
		$modify = str_replace('{{lowerControllerPrefix}}', $lowerControllerPrefix, $modify);
		$modify = str_replace('{{lowerCrudModel}}', $lowerCrudModel, $modify);
		\Storage::disk('local')->put('crudPartial/'.$lowerControllerPrefix . $crudModel . '/views/modify.stub', $modify);
		
		// JS Footer
		$jsFooter = \Storage::disk('local')->get('crudStubs/js/scripts.stub');
		$jsFooter = str_replace('{{lowerControllerPrefix}}', $lowerControllerPrefix, $jsFooter);
		$jsFooter = str_replace('{{lowerCrudModel}}', $lowerCrudModel, $jsFooter);
		\Storage::disk('local')->put('crudPartial/'.$lowerControllerPrefix . $crudModel . '/js/scripts.stub', $jsFooter);
		
		$this->info('A set of partial files has been added to ' . storage_path('crudPartial/' . $lowerControllerPrefix . $crudModel));
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	// protected function getArguments()
	// {
		// return [
			// ['example', InputArgument::REQUIRED, 'An example argument.'],
		// ];
	// }

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['controllerPrefix', null, InputOption::VALUE_REQUIRED, 'Controller name (ie. Test for TestController)', null],
			['crudModel', null, InputOption::VALUE_REQUIRED, 'Name of crud object (ie. Contact)', null],
		];
	}

}
