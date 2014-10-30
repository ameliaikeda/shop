<?php

return [

	/**
	 * What currency is the shop in by default?
	 *
	 * Accepted values are three-letter currency codes,
	 * e.g. "gbp", "usd", "cny", "jpy", "cad", "eur"
	 */
	"currency" => "gbp",

	/**
	 * Taxes are not very fun.
	 * NB: I'm not doing sales tax for the USA. Make your own TaxService.
	 */
	"tax" => [

		/**
		 * Do we want sales tax?
		 *
		 * This is either false or a string containing a float
		 * (Since PHP is funky with floats sometimes...)
		 */
		"sales" => false,

		/**
		 * Are we adding VAT onto prices?
		 *
		 * Note: unless you make over £81k a year, you really
		 * don't need this by default. Don't charge VAT without
		 * a VAT number (in the UK, at least)
		 *
		 * This is either false or a float (as a string).
		 */
		"vat" => false, // or "20.0"
	],

];
