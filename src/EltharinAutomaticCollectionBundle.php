<?php

namespace Eltharin\AutomaticCollection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class EltharinAutomaticCollectionBundle extends AbstractBundle
{
	public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
	{
		$container->extension('twig', [
			'form_themes' => ['@EltharinAutomaticCollection/__form_automatic_collection_widget.html.twig']
		]);
	}
}