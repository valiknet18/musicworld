<?php
namespace Valiknet\MusicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Valiknet\MusicBundle\Form\DataTransformer\UrlTransformer;

class ClipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new UrlTransformer();

        $builder
            ->add('name', 'text', [
                "label" => "Назва кліпу",
            ])
            ->add('text', 'textarea', [
                "label" => "Опис кліпу"
            ])
            ->add(
                $builder->create('video', 'url', [
                    "label" => "Посилання на кліп в ютубі"
                ])
                    ->addModelTransformer($transformer)
            );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Valiknet\MusicBundle\Entity\Clip',
        ));
    }

    public function getName()
    {
        return 'add_clip';
    }
}
