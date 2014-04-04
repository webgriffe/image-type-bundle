<?php
/**
 * Created by JetBrains PhpStorm.
 * User: azambon
 * Date: 05/09/13
 * Time: 10.06
 * To change this template use File | Settings | File Templates.
 */

namespace Webgriffe\ImageTypeBundle\Form\Type;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\PropertyMappingFactory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Webgriffe\ImageTypeBundle\Form\DataTransformer\PathNameToFileTransformer;

class ImageType extends AbstractType
{
    /**
     * @var string
     */
    private $webDir;

    /**
     * @var PropertyMappingFactory
     */
    private $factory;

    public function __construct($webDir, PropertyMappingFactory $factory)
    {
        $this->webDir = $webDir;
        $this->factory = $factory;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->resetModelTransformers();
        $builder->addModelTransformer(new PathNameToFileTransformer($this->webDir));
    }

    public function getParent()
    {
        return 'file';
    }

    public function getName()
    {
        return 'image';
    }

    /**
     * Add the image_path option
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('uplodify_fileTypeExts' => '*.gif; *.jpg; *.png; *.jpeg; *.bmp'));
        $resolver->setOptional(array('image_path'));
    }

    /**
     * Pass the image url to the view
     *
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (array_key_exists('image_path', $options)) {
            $parentData = $form->getParent()->getData();

            $imageUrl = null;
            if (null !== $parentData) {
                $accessor = PropertyAccess::createPropertyAccessor();
                $mapping = $this->factory->fromField($parentData, $form->getPropertyPath());
                $propertyPath = $mapping->getFileNamePropertyName(); // TODO Prendere property attraverso annotation sul UploadableField
                $uriPrefix = $mapping->getUriPrefix(); // TODO Prendeer da annotation sul UploadableField
                $imagePath = $accessor->getValue($parentData, $propertyPath);
                $imageUrl = $uriPrefix . $imagePath;
            }

            // set an "image_url" variable that will be available when rendering this field
            $view->vars['image_url'] = $imageUrl;
        }
        $view->vars['uplodify_fileTypeExts'] = $options['uplodify_fileTypeExts'];
    }
}
