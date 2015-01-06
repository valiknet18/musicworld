<?php
namespace Valiknet\MusicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StyleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                "label" => "Назва Стилю",
            ])
            ->add('parent', 'entity', [
                "class" => 'Valiknet\MusicBundle\Entity\Style',
                "label" => "Виберіть батька",
                "empty_value" => "Виберіть батьківський тип"
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Valiknet\MusicBundle\Entity\Style',
        ));
    }

    public function getName()
    {
        return 'add_style';
    }
}
