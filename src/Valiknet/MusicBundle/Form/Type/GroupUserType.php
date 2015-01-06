<?php
namespace Valiknet\MusicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('group', 'entity', [
                "class" => 'Valiknet\MusicBundle\Entity\Group',
                "label" => "Виберіть группу в якій участвують"
            ])
            ->add('role', 'choice', [
                "choices" => [
                    "Гітарист",
                    "Барабанщик",
                    "Басист",
                    "Вокаліст",
                    "Клавішнік",
                    "Ді-джей",
                    "Саксофоніст"
                ],
                "label" => "Роль"
            ])
            ->add('joinedAt', "date", [
                "label" => "Дата входу в групу",
                "years" => range(1950, 2015)
            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Valiknet\MusicBundle\Entity\GroupUser',
        ));
    }

    public function getName()
    {
        return 'add_group_user';
    }
}
