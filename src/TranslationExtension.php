<?php

declare(strict_types=1);

namespace Archette\Translation;

use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use Rixafy\Translation\TranslationConfig;

class TranslationExtension extends CompilerExtension
{
	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'defaultLanguage' => Expect::string('en')
		]);
	}

	public function loadConfiguration()
	{
		$this->getContainerBuilder()->addDefinition($this->prefix('languageFacade'))
			->setFactory(TranslationConfig::class)
			->addSetup('setCurrentLanguage', [$this->config->defaultLanguage]);
	}
}
