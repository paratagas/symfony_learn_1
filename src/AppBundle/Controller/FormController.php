<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Task;
use AppBundle\Form\Type\TaskType;

// типы ниже должны поключаться только для PHP 5.5 и выше
//use Symfony\Component\Form\Extension\Core\Type\TextType;
//use Symfony\Component\Form\Extension\Core\Type\DateType;
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormController extends Controller
{
    /**
     * @Route("/form_base", name="_form_base")
     */
    public function newAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Task();

        // можно сразу установить свои значения
        // для свойств объекта
        //$task->setTask('Write a blog post');
        //$task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            // If you use PHP 5.5 or higher you must use
            //->add('task', TextType::class)

            // If you use PHP 5.3 or 5.4 you must use
            ->add('task', 'Symfony\Component\Form\Extension\Core\Type\TextType')

            //->add('dueDate', DateType::class)
            ->add('dueDate', 'Symfony\Component\Form\Extension\Core\Type\DateType',
                    array(
                        'label' => 'Custom label for DueDate',
                        // можно отобразить свойство, как текстовое поле
                        // 'widget' => 'single_text'
                        // для получения всех опций каждого типа поля см:
                        // http://symfony.com/doc/2.8/reference/forms/types
                    )
                )

            //->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType',
                array('label' => 'Create Task'))
            // можно делать несколько сабмит кнопок в зависимости от потребностей
            ->add('saveAndAdd', 'Symfony\Component\Form\Extension\Core\Type\SubmitType',
                array('label' => 'Save and Add'))

            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ... perform some action, such as saving the task to the database

            // если сабмит по кнопке saveAndAdd - редирект на эту же форму
            // иначе сабмит по кнопке Create Task и редирект на _form_task_success
            $nextAction = $form->get('saveAndAdd')->isClicked()
                ? '_form_base'
                : '_form_task_success';

            return $this->redirectToRoute($nextAction);
        }

        return $this->render('form/form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/form_task_success", name="_form_task_success")
     */
    public function successAction()
    {
        return new Response(
            "<html><body><p>Form successfully submitted</p></body></html>"
        );
    }

    /**
     * @Route("/form_external", name="_form_external")
     */
    public function externalAction(Request $request)
    {
        $task = new Task();

        // создание формы из отдельного класса
        $form = $this->createForm('AppBundle\Form\Type\TaskType', $task);
        // PHP 5.5 и выше
        //$form = $this->createForm(TaskType::class, $task);

        return $this->render('form/form.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}