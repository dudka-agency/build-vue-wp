<?php

/**
 * Install WP-CLI
 *
 * curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
 */

if (class_exists('WP_CLI')) {
	try {
		WP_CLI::add_command('wpacu_clear_assets_cache', function () {
			if (class_exists('\WpAssetCleanUp\OptimiseAssets\OptimizeCommon')) {
				try {
					\WpAssetCleanUp\OptimiseAssets\OptimizeCommon::clearCache(false);

					WP_CLI::success('Asset CleanUp - The cache was deleted.');
				} catch (Exception $e) {
					WP_CLI::error('Asset CleanUp - ' . $e->getMessage());
				}
			} else {
				WP_CLI::log('Asset CleanUp plugin is not installed');
			}

			if (function_exists('w3tc_flush_all')) {
				try {
					w3tc_flush_all();

					WP_CLI::success('WP Total Cache - All caches successfully emptied.');
				} catch (Exception $e) {
					WP_CLI::error('WP Total Cache - ' . $e->getMessage());
				}
			} else {
				WP_CLI::log('WP Total Cache plugin is not installed');
			}
		});
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}