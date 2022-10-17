Symfony AutomaticCollection Bundle
==========================

[![Latest Stable Version](http://poser.pugx.org/eltharin/automaticcollection/v)](https://packagist.org/packages/eltharin/automaticcollection) 
[![Total Downloads](http://poser.pugx.org/eltharin/automaticcollection/downloads)](https://packagist.org/packages/eltharin/automaticcollection) 
[![Latest Unstable Version](http://poser.pugx.org/eltharin/automaticcollection/v/unstable)](https://packagist.org/packages/eltharin/automaticcollection) 
[![License](http://poser.pugx.org/eltharin/automaticcollection/license)](https://packagist.org/packages/eltharin/automaticcollection)

Installation
------------

* Require the bundle with composer:

``` bash
composer require eltharin/automaticcollection
```

You can use eltharin/twigfilesgetter for load unique Js : https://github.com/eltharin/TwigFilesGetter 

In this case, you just have to write {{ get_required_js_files() }} in your twig base template to load JS file. 

Otherwise you have to import /bundles/eltharinautomaticcollection/js/automaticcollection.js manually


What is AutomaticCollection Bundle?
---------------------------
This bundle will render automatic add and delete elements for Collection Type.

When allow_add param will be set, the bundle will automaticly add a button for add a new row.

When allow_delete param will be set the bundle will automaticly add a delete row button on each line,

When allow_delete param is not set, you can have the delete button only for the new rows.


Use It : 
---------------------------

You have two Form Types: 

PrincipalType :

``` php
class PrincipalType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add('numero')
			->add('libelle')
			->add('users', AutomaticCollectionType::class, [
						'entry_type' =>  SecondType::class,
						'allow_add' => true,
						'allow_delete' => true,
						'by_reference' => false,
						'add_button_string' => '<button type="button" class="automatic_collection_addBtn" data-collection-holder-class="{{ id }}">New</button>',
						'delete_button_string' => '<button type="button" class="btn danger automatic_collection_delBtn">Suppr</button>'
					]);
		;
	}

	public function configureOptions(OptionsResolver $resolver): void
	{
		$resolver->setDefaults([
			'data_class' => null,
		]);
	}
}
```

And SecondType : 

``` php
class SecondType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		$builder
			->add('lastname')
			->add('surname')
		;
	}

	public function configureOptions(OptionsResolver $resolver): void
	{
		$resolver->setDefaults([
			'data_class' => null,
		]);
	}
}
```

In PrincipalType, the options allow_add and allow_delete (from CollectionType) will automaticlly add buttons add and delete on each row.

When you add a new row, the button delete will be shown no matter that the allow_delete is at true.

you can change HTML button : 
> by set the HTML String with the options add_button_string and delete_button_string, don't forget classes automatic_collection_addBtn and automatic_collection_delBtn for JS and data-collection-holder-class="{{ id }}" (change in future version)
> or by replacing twig templates: 
``` twig
{%- block automatic_collection_add_button_widget -%}
    <button type="button" class="automatic_collection_addBtn" data-collection-holder-class="{{ id }}">New</button>
{%- endblock automatic_collection_add_button_widget -%}

{%- block automatic_collection_delete_button_widget -%}
    <button type="button" class="btn danger automatic_collection_delBtn">Suppr</button>
{%- endblock automatic_collection_delete_button_widget -%}
```
