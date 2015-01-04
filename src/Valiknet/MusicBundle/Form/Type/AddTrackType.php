<?php
namespace Valiknet\MusicBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Valiknet\MusicBundle\Entity\Group;

class AddTrackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                "attr" => [
                    "class" => "col-lg-6"
                ]
            ])
            ->add('timeline', 'text', [
                "attr" => [
                    "class" => "col-lg-4"
                ]
            ])
            ->add('release', 'hidden', [

            ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Valiknet\MusicBundle\Entity\Track',
        ));
    }

    public function getName()
    {
        return 'add_release';
    }
}
