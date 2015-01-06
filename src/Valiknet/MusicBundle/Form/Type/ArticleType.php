<?php
namespace Valiknet\MusicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                "label" => "Назва статі",
            ])
            ->add('text', 'textarea', [
                "label" => "Опис статі"
            ])
            ->add('groups', 'entity', [
                "class" => 'Valiknet\MusicBundle\Entity\Group',
                "multiple" => true
            ])
            ->add('users', 'entity', [
                "class" => 'Valiknet\MusicBundle\Entity\User',
                "multiple" => true
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Valiknet\MusicBundle\Entity\Article',
        ));
    }

    public function getName()
    {
        return 'create_article';
    }
}
