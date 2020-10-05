<?php

namespace App\Form;

use App\Entity\FishCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Umbrella\CoreBundle\Form\ParentEntityTree2Type;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Class FishCategoryType
 */
class FishCategoryType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class);
        $builder->add('description', TextareaType::class, [
            'attr' => [
                'rows' => 8
            ]
        ]);
        $builder->add('parent', ParentEntityTree2Type::class, [
            'class' => FishCategory::class,
            'current_node' => $builder->getData()
        ]);
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FishCategory::class
        ]);
    }
}
