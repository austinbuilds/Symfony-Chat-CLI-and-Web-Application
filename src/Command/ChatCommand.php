<?php
  namespace App\Command;

  use Symfony\Component\Console\Command\Command;
  use Symfony\Component\Console\Input\InputInterface;
  use Symfony\Component\Console\Output\OutputInterface;
  use Symfony\Component\Console\Input\InputArgument;
  // Services
  use App\Service\AddMessage;


  class ChatCommand extends Command
  {
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'write:message';

    protected function configure()
    {
      $this
      // the short description shown while running "php bin/console list"
      ->setDescription('Send a message to the chat application.')

      // the full command description shown when running the command with
      // the "--help" option
      ->setHelp('This command allows you to send a message to the chat application as the chat bot.')

      // configure an argument
      ->addArgument('message', InputArgument::REQUIRED, 'Please enter a message for the bot to send.')
      ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      // outputs multiple lines to the console (adding "\n" at the end of each line)
      $output->writeln([
        'Chat Application',
        '================',
        '',
        'To view application in the browser:',
        'Run: php -S 127.0.0.1:8000 -t public',
        'Open: Browser to 127.0.0.1:8000',
        '',
        'Sending message: '.$input->getArgument('message'),
        ''
      ]);

      $output->writeln(AddMessage::sendMessage($input->getArgument('message'), $type = 'bot'));

      return 0;
    }
  }
?>