<?php
namespace Valiknet\MusicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UpdateReleaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('poster', 'file', [
                "label" => "Постер релізу",
                "required" => false,
            ])
            ->add('type', 'choice', [
                "label" => "Тип релізу",
                "required" => false,
                "choices" => [
                    "Album",
                    "Single",
                    "Remixer",
                    "EP(Extended Play)",
                    "Compilation",
                    "Mixtape",
                    "Soundtrack",
                    "Live",
                    "Bootleg",
                    "Promo",
                    "Tribute(cover)",
                    "Demo",
                ],
                "empty_value" => "Виберіть тип релізу"
            ])
            ->add('name', 'text', [
                "label" => "Назва релізу"
            ])
            ->add('text', 'textarea', [
                "label" => "Опис релізу"
            ])
            ->add('releasedAt', 'date', [
                "label" => "Дата виходу релізу",
                "years" => range(1950, 2020)
            ]);
//            ->add('tracks', 'collection', [
//                "data_class" => 'Valiknet\MusicBundle\Entity\Track',
//                "type" => new AddTrackType(),
//                "label" => "Список треків",
//                "allow_add" => true,
//                "allow_delete" => true,
//            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Valiknet\MusicBundle\Entity\Release',
        ));
    }

    public function getName()
    {
        return 'add_release';
    }
}
