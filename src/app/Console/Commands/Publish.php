<?php namespace Amelia\Shop\Console\Commands;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Publish extends Command {

	/**
	 * Package name.
	 *
	 * @var string
	 */
	protected $package = "amelia/shop";

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'shop:publish';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Publish assets, views, config and (optionally) controllers';

	/**
	 * Create a new command.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire() {
		$name = $this->getShopName();

		$this->publishConfig();
		$this->publishViews();
		$this->publishAssets();

		if ($this->option("controllers"))
			$this->publishControllers();
	}

	/**
	 * Get your shop name
	 *
	 * @return array|string|void
	 */
	protected function getShopName() {
		if ($name = $this->argument("name"))
			return $name;

		return $this->question("What should I call your shop?");
	}

	/**
	 * Publish our config to laravel
	 */
	protected function publishConfig() {
		$this->call("config:publish", ["package" => $this->package]);
	}

	/**
	 * Publish shop views to laravel
	 */
	protected function publishViews() {
		$this->call("view:publish", ["package" => $this->package]);
	}

	/**
	 * Publish assets to the installation of laravel
	 */
	protected function publishAssets() {
		$this->call("asset:publish", ["package" => $this->package]);
	}

	/**
	 * Publish controllers by setting routing to true
	 *
	 * @param \Illuminate\Contracts\Config\Repository $config
	 */
	protected function publishControllers(Repository $config) {
		$config->set("shop::shop.routing", true);
	}

	/**
	 * Command-line options
	 *
	 * @return array
	 */
	public function getOptions() {
		return [
			["controllers", "c", InputOption::VALUE_OPTIONAL, "Add controller routing?", null],
		];
	}

	/**
	 * Command-line arguments
	 *
	 * @return array
	 */
	public function getArguments() {
		return [
			["name", InputArgument::OPTIONAL, "Shop name", false],
		];
	}

}
