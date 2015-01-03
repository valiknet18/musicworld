<?php
namespace Valiknet\MusicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddGroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                "label" => "Назва групи"
            ])
            ->add('history', 'textarea', [
                "label" => "Інформація про групу"
            ])
            ->add('officialSite', 'text', [
                "label" => "Офіційний сайт"
            ])
            ->add('officialVkPage', 'text', [
                "label" => "Офіційна сторінка вконтакті"
            ])
            ->add('officialTwitterPage', 'text', [
                "label" => "Офіційна сторінка в твіттері"
            ])
            ->add('officialFacebookPage', 'text', [
                "label" => "Офіційна сторінка в фейсбукі"
            ])
            ->add('country', 'entity', [
                "class" => "ValiknetMusicBundle:Country",
                "empty_value" => "Виберіть потрібну країну",
            ])
            ->add('styles');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Valiknet\MusicBundle\Entity\Group',
        ));
    }

    public function getName()
    {
        return 'comment';
    }
}
