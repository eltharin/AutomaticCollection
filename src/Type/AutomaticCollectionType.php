<?php

namespace Eltharin\AutomaticCollection\Type;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\PersistentCollection;
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
	public function getParent() : ?string
	{
		return CollectionType::class;
	}

	public function buildView(FormView $view, FormInterface $form, array $options) : void
	{
		if(class_exists(FileManager::class ))
		{
			FileManager::registerJsFile('/bundles/eltharinautomaticcollection/js/automaticcollection.js');
		}

		$view->vars['row_attr']['class'] = $view->vars['row_attr']['class'] ?? '' . ' form-collection';


		$view->vars['automatic_collection_add_button_block'] = $options['add_button_block'];
		$view->vars['automatic_collection_delete_button_block'] = $options['delete_button_block'];

		/*if($options['allow_add'])
		{

			$view->vars['automatic_collection_add_button_widget'] = $options['automatic_collection_add_button_widget'];
		}*/

		$view->vars['attr']['class'] = ($view->vars['attr']['class'] ?? '') . ' form-row-collection';
		$data = ($view->vars['data'] instanceof Collection) ? $view->vars['data']->toArray() : $view->vars['data'];
		$view->vars['attr']['data-index'] = $data ? max(array_keys($data))+1 : 0; //-- on positionne l'index en fonction du plus grand existant

		if($options['allow_delete'])
		{
			$view->vars['attr']['class'] = ($view->vars['attr']['class'] ?? '') . ' form-row-deletable';

		}

		$view->vars['row_attr']['allow_delete'] = $options['allow_delete'];
		$view->vars['params'] = $options['params'];
		$view->vars['data-collection-holder-class'] = $view->vars['id'];
	}

	public function getBlockPrefix() : string
	{
		return 'automatic_collection';
	}

	public function configureOptions(OptionsResolver $resolver): void
	{
		$resolver->setDefaults([
			'add_button_block' => 'automatic_collection_add_button_widget',
			'delete_button_block' => 'automatic_collection_delete_button_widget',
			'by_reference' => false, // for use add function from parent
			'params' => [],
		]);
	}
	public function finishView(FormView $view, FormInterface $form, array $options) : void
	{
		foreach ($view as $entryView)
		{
			$offset = array_search('collection_entry', $entryView->vars['block_prefixes']);
			array_splice($entryView->vars['block_prefixes'], $offset+1, 0, 'automatic_collection_entry');

			$entryView->vars['row_attr']['class'] = ($entryView->vars['row_attr']['class'] ?? '') . ' automatic-collection-entry-row';
		}

		/** @var FormInterface $prototype */
		if ($prototype = $form->getConfig()->getAttribute('prototype'))
		{

			$offset = array_search('collection_entry', $view->vars['prototype']->vars['block_prefixes']);
			array_splice($view->vars['prototype']->vars['block_prefixes'], $offset+1, 0, 'automatic_collection_entry');
		}
	}
}
