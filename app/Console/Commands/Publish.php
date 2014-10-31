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

	protected function publishConfig() {
		$this->call("config:publish", ["package" => $this->package]);
	}

	protected function publishViews() {
		$this->call("view:publish", ["package" => $this->package]);
	}

	protected function publishAssets() {
		$this->call("asset:publish", ["package" => $this->package]);
	}

	protected function publishControllers(Repository $config) {
		$config->set("shop::shop.routing", true);
	}

}
