<?php
namespace Valiknet\MusicBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Valiknet\MusicBundle\Entity\Group;

class AddGroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('poster', 'file', [
                "label" => "Постер группи",
                "required" => false
            ])
            ->add('name', 'text', [
                "label" => "Назва групи",
                "required" => true
            ])
            ->add('history', 'textarea', [
                "label" => "Інформація про групу",
                "required" => true
            ])
            ->add('officialSite', 'url', [
                "label" => "Офіційний сайт",
                "required" => false
            ])
            ->add('officialVkPage', 'url', [
                "label" => "Офіційна сторінка вконтакті",
                "required" => false
            ])
            ->add('officialTwitterPage', 'url', [
                "label" => "Офіційна сторінка в твіттері",
                "required" => false
            ])
            ->add('officialFacebookPage', 'url', [
                "label" => "Офіційна сторінка в фейсбукі",
                "required" => false
            ])
            ->add('country', 'entity', [
                "class" => "ValiknetMusicBundle:Country",
                "empty_value" => "Виберіть потрібну країну",
                "required" => true
            ])
            ->add('createdAt', 'date', [
                "label" => "Дата створення группи",
                "required" => true,
                "years" => range(1950, 2015),
            ])
            ->add("styles", 'entity', [
                "class" => 'ValiknetMusicBundle:Style',
                "multiple" => "true",
                "expanded" => true,
                "label" => "Жанри"
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Valiknet\MusicBundle\Entity\Group',
        ));
    }

    public function getName()
    {
        return 'group';
    }
}
