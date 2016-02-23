<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    /*
    // можно указать сущность прямо в классе формы, а не в контроллере
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Task',
        ));
    }
    */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task')
            ->add('dueDate', null, array('widget' => 'single_text'))
            // PHP 5.5 и выше
            //->add('save', SubmitType::class)
            ->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType')
        ;

        // добавление в форму поля для объекта класса CategoryType
        // позволяет подключать в одну форму поля разных классов
        $builder->add('category', 'AppBundle\Form\Type\CategoryType');
    }
}