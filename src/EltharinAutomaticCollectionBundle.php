<?php

namespace Eltharin\AutomaticCollection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\Yaml\Parser;

class EltharinAutomaticCollectionBundle extends AbstractBundle
{
	public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
	{
		$yamlParser = new Parser();
		$doctrineConfig = $yamlParser->parse(file_get_contents(__DIR__ . '/../config/twig.yaml'));
		$builder->prependExtensionConfig('twig', $doctrineConfig['twig']);
	}
}