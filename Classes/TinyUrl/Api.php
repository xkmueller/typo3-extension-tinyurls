<?php
namespace Tx\Tinyurls\TinyUrl;

/*                                                                        *
 * This script belongs to the TYPO3 extension "tinyurls".                 *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU General Public License, either version 3 of the   *
 * License, or (at your option) any later version.                        *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use Tx\Tinyurls\Utils\ConfigUtils;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Use this class for generating tiny URLs in your own extension
 *
 * @api
 */
class Api {

	/**
	 * @var TinyUrlGenerator
	 */
	var $tinyUrlGenerator;

	/**
	 * @var ConfigUtils
	 */
	var $tinyUrlConfigUtils;

	/**
	 * Initializes the tinyUrl generator
	 */
	public function __construct() {
		$this->tinyUrlGenerator = GeneralUtility::makeInstance(TinyUrlGenerator::class);
		$this->tinyUrlConfigUtils = GeneralUtility::makeInstance(ConfigUtils::class);
	}

	/**
	 * Returns the final tiny URL for the given target URL using the
	 * configuration options that have been provided by the setters or
	 * by TypoScript
	 *
	 * @param string $targetUrl
	 * @return string the tiny URL
	 * @api
	 */
	public function getTinyUrl($targetUrl) {
		return $this->tinyUrlGenerator->getTinyUrl($targetUrl);
	}

	/**
	 * Initializes the configuration of the tiny URL generator based on the given
	 * TypoScript configuration. The content object is used to parse values with
	 * stdWrap
	 *
	 * @param array $config the TypoScript configuration of a typolink, the config options must be set within the tinyurl. namespace
	 * @param ContentObjectRenderer $contentObject The parent content object (used for running stdWrap)
	 * @api
	 */
	public function initializeConfigFromTyposcript($config, $contentObject) {
		$this->tinyUrlConfigUtils->initializeConfigFromTyposcript($config, $contentObject, $this->tinyUrlGenerator);
	}

	/**
	 * Sets the deleteOnUse option, if TRUE the URL will be deleted from
	 * the database on the first hit
	 *
	 * @param bool $deleteOnUse
	 */
	public function setDeleteOnUse($deleteOnUse) {
		$this->tinyUrlGenerator->setOptionDeleteOnUse($deleteOnUse);
	}

	/**
	 * Sets a custom URL key, must be unique
	 *
	 * @param string $urlKey
	 */
	public function setUrlKey($urlKey) {
		$this->tinyUrlGenerator->setOptionUrlKey($urlKey);
	}

	/**
	 * Sets the timestamp until the generated URL is valid
	 *
	 * @param int $validUntil
	 */
	public function setValidUntil($validUntil) {
		$this->tinyUrlGenerator->setOptionValidUntil($validUntil);
	}
}
