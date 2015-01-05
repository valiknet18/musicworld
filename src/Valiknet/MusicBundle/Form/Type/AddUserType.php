<?php
namespace Valiknet\MusicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Valiknet\MusicBundle\Form\DataTransformer\UrlTransformer;

class AddUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new UrlTransformer();

        $builder
            ->add('name', 'text', [
                "label" => "Ім’я людини",
            ])
            ->add('lastname', 'text', [
                "label" => "Прізвище"
            ])
            ->add('history', 'textarea', [
                "label" => "Коротка історія"
            ])
            ->add('birthedAt', 'date', [
                "label" => "Дата народження",
                "years" => range(1950, 2015)
            ])
            ->add('photo', 'file', [
                "label" => "Фото людини"
            ])
            ->add('officialSite', 'url', [
                "label" => "Офіційний сайт"
            ])
            ->add('officialVkPage', "url", [
                "label" => "Офіційна сторінка вконтакті"
            ])
            ->add('officialTwitterPage', "url", [
                "label" => "Офіційна сторінка в твітері"
            ])
            ->add('officialFacebookPage', "url", [
                "label" => "Офіційна сторінка в фейсбукі"
            ])
            ->add('country', 'entity', [
                "class" => 'Valiknet\MusicBundle\Entity\Country',
                "label" => "Країна",
                "empty_value" => "Виберіть потрібну країну"
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Valiknet\MusicBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'add_user';
    }
}
