<?php

namespace Eltharin\AutomaticCollection\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\EventListener\ResizeFormListener;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Markup;
use Eltharin\TwigFilesGetterBundle\Service\FileManager;

class AutomaticCollectionType extends AbstractType
{
	public function getParent()
	{
		return CollectionType::class;
	}

	public function buildView(FormView $view, FormInterface $form, array $options)
	{
		if(!empty($view->vars['allow_add']))
		{
			$view->vars['row_attr']['class'] = $view->vars['row_attr']['class'] ?? '' . ' form-collection';
		}

		if($options['allow_delete'])
		{
			$view->vars['attr']['class'] = $view->vars['attr']['class'] ?? '' . ' form-row-deletable';
			FileManager::registerJsFile('/bundles/eltharinautomaticcollection/js/form-row-deletable.js');
		}
	}

	public function getBlockPrefix()
	{
		return 'automatic_collection';
	}

}