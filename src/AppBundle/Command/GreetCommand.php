<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GreetCommand
 * @package AppBundle\Command
 *
 * Мой класс, позволяющий создавать консольную команду
 * Запустить (с аргументом и двумя настройками): php app/console app:demo:greet Eugene --upper --time
 * Запустить (с аргументом и двумя настройками): php app/console app:demo:greet Eugene --lower --time
 * Запустить (с аргументом и второй настройкой): php app/console app:demo:greet Eugene --time
 * Запустить (без аргумента и с настройкой): php app/console app:demo:greet --upper
 * Запустить (без аргумента и без настроек): php app/console app:demo:greet
 */
class GreetCommand extends ContainerAwareCommand
{
    private $myMessage = "Start message:";

    protected function configure()
    {
        $this
            // a good practice is to use the 'app:' prefix to group your custom application commands
            ->setName('app:demo:greet')
            ->setDescription('Greet someone')
            // мои аргументы
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
            // мои настройки - их наличие позволяет задавать какие-либо опции
            ->addOption(
                'upper',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will yell in uppercase letters'
            )
            ->addOption(
                'lower',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will yell in lowercase letters'
            )
            ->addOption(
                'time',
                null,
                InputOption::VALUE_NONE,
                'If set, the time will be added'
            )
        ;
    }

    /**
     * This method is executed before the interact() and the execute() methods.
     * It's main purpose is to initialize the variables used in the rest of the
     * command methods.
     *
     * Beware that the input options and arguments are validated after executing
     * the interact() method, so you can't blindly trust their values in this method.
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->myMessage .= " plus initialized";
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // какая-то обработка данных с помощью кастомного метода класса
        $this->myMessage = $this->myInternalMethod($this->myMessage);

        // получение аргумента консоли
        $name = $input->getArgument('name');

        if ($name) {
            $text = 'Hello ' . $name . PHP_EOL . $this->myMessage;
        } else {
            $text = 'Hello' . PHP_EOL . $this->myMessage;
        }

        // проверка настроек
        if ($input->getOption('upper')) {
            $text = strtoupper($text);
        }

        if ($input->getOption('lower')) {
            $text = strtolower($text);
        }

        if ($input->getOption('time')) {
            $text .= " " . time();
        }

        // вывод обратно в консоль
        $output->writeln($text);
    }

    /**
     * This internal method should be private, but it's declared as public to
     * maintain PHP 5.3 compatibility when using it in a callback.
     *
     * @internal
     */
    public function myInternalMethod($message)
    {
        $message .= " plus added by internal custom method";
        return $message;
    }
}