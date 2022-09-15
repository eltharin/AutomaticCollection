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
		if(class_exists(FileManager::class ))
		{
			FileManager::registerJsFile('/bundles/eltharinautomaticcollection/js/automaticcollection.js');
		}

		$view->vars['row_attr']['class'] = $view->vars['row_attr']['class'] ?? '' . ' form-collection';

		if($options['allow_add'])
		{
			$view->vars['row_attr']['data-addbtn'] = $options['addbtn'];
		}

		$view->vars['attr']['class'] = ($view->vars['attr']['class'] ?? '') . ' form-row-collection';
		$view->vars['attr']['data-index'] = $view->vars['data'] ? max(array_keys($view->vars['data']))+1 : 0; //-- on positionne l'index en fonction du plus grand existant

		if($options['allow_delete'])
		{
			$view->vars['attr']['class'] = ($view->vars['attr']['class'] ?? '') . ' form-row-deletable';
			$view->vars['row_attr']['data-delbtn'] = $options['delbtn'];
		}
	}

	public function getBlockPrefix()
	{
		return 'automatic_collection';
	}

	public function configureOptions(OptionsResolver $resolver): void
	{
		$resolver->setDefaults([
			'addbtn' => '<button type="button">New</button>',
			'delbtn' => '<button type="button">Suppr</button>',
		]);
	}
}