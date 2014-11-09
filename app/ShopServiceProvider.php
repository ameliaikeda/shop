<?php namespace Amelia\Shop;

use Illuminate\Support\ServiceProvider;

class ShopServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		$this->registerBilling();
		$this->registerCart();
		$this->registerRepositories();
		$this->registerContracts();
	}

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot() {
		$this->package("amelia/shop", "shop", __DIR__ . "/../");
		$this->bootControllers();
	}

	protected function bootControllers() {
		if ($this->app->make("config")->get("shop::shop.routing", false))
			include __DIR__ . "/Http/routes.php";
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			"cart",
			"Amelia\\Shop\\Services\\Cart\\CartService",

			"Amelia\\Shop\\Contracts\\Customer",
			"Amelia\\Shop\\Contracts\\Card",
			"Amelia\\Shop\\Contracts\\Order",
			"Amelia\\Shop\\Contracts\\Product",

			"Amelia\\Shop\\Repositories\\CustomerRepository",
			"Amelia\\Shop\\Repositories\\ProductRepository",

			"Amelia\\Shop\\Services\\Billing\\BillingService",
			"Amelia\\Shop\\Services\\Billing\\TaxService",
		];
	}

	/**
	 * Register the Cart IoC entry
	 *
	 * @return void
	 */
	protected function registerCart() {
		// cart services
		$this->app->bind("Amelia\\Shop\\Services\\Cart\\CartService", "Amelia\\Shop\\Services\\Cart\\SessionCartService");

		// bind facade endpoints
		$this->app->bind("cart", function ($app) {
			return $app->make("Amelia\\Shop\\Services\\Cart\\CartService");
		});
	}

	/**
	 * Bind contracts to implementations for core models
	 *
	 * @return void
	 */
	protected function registerContracts() {
		// contracts to implementations
		$this->app->bind("Amelia\\Shop\\Contracts\\Customer", "Amelia\\Shop\\User");
		$this->app->bind("Amelia\\Shop\\Contracts\\Card", "Amelia\\Shop\\Card");
		$this->app->bind("Amelia\\Shop\\Contracts\\Order", "Amelia\\Shop\\Order");
		$this->app->bind("Amelia\\Shop\\Contracts\\Product", "Amelia\\Shop\\Product");
	}

	/**
	 * Register a repository structure for getting collections
	 *
	 * @return void
	 */
	protected function registerRepositories() {
		$this->app->bind("Amelia\\Shop\\Repositories\\CustomerRepository", "Amelia\\Shop\\Repositories\\EloquentCustomerRepository");
		$this->app->bind("Amelia\\Shop\\Repositories\\ProductRepository", "Amelia\\Shop\\Repositories\\EloquentProductRepository");
	}

	/**
	 * Register the billing/tax services
	 *
	 * @return void
	 */
	protected function registerBilling() {
		$this->app->bind("Amelia\\Shop\\Services\\Billing\\BillingService", "Amelia\\Shop\\Services\\Billing\\StripeBillingService");
		$this->app->bind("Amelia\\Shop\\Services\\Billing\\TaxService", "Amelia\\Shop\\Services\\Billing\\NaiveTaxService");
	}
}