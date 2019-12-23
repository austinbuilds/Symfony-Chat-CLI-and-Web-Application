# :speech_balloon: Symfony-Chat-CLI-and-Web-Application

Symfony CLI and web application with chat functionality. Can be used to send incoming messages as a "chat bot" from the CLI and replied to with outgoing messages as the "user" from the web application. Communications are persisted in `.json` files: `incoming.json`, `outgoing.json`, and `conversation.json`.

## :floppy_disk: Install

Dependencies:

- [composer](https://getcomposer.org)
- [symfony](https://symfony.com)
- symfony/console
- symfony/filesystem
- annotations
- twig

Recommeneded:

```console
composer create-project symfony/website-skeleton my_project_name
composer require symfony/console
composer require symfony/filesystem
composer require annotations
composer require twig
```

:pushpin: Depending on method, if composer.phar is not globally installed and placed in project root folder, use: `php composer.phar create-project symfony/website-skeleton my_project_name`

Run:

In project dir

```console
php -S 127.0.0.1:8000 -t public
```

Browse to http://localhost:8000/

Quit with ctrl-c

## :computer: Technologies Demonstrated

- HTML
- CSS
- Bootstrap
- PHP
- Symfony
- Symfony/Console
- Symfony/Filesystem
- Twig
- Composer
- JSON

## :memo: Notes

### Routes

Routes.yaml or annotations

> NamedController.php

```php
/**
 * @Route("/", name="home", methods={"GET"})
 */
```

<hr>

### Response

> ChatController.php

```php
return new Response('<html><body>Hello</body></html>');

// Or with data

$messages = ["Hello", "Hello, again."];
return $this->render('chat/index.html.twig', array('messages' => $messages));
```

<hr>

### POST request

> ChatController.php

```php
/**
 * @Route("/", methods={"POST"})
 */
public function addMessage(Request $request) {
  // Request
  $message = $request->request->get('userMessage');

  // sendMessage
  AddMessage::sendMessage($message, $type = 'user');

  // Redirect
  return $this->redirectToRoute('home');
}
```

<hr>

### Templating

> The Twig templating language allows you to write concise, readable templates that are more friendly to web designers and, in several ways, more powerful than PHP templates. Take a look at the following Twig template example. Even if it's the first time you see Twig, you probably understand most of it:

```html
<!DOCTYPE html>
<html>
  <head>
    <title>Welcome to Symfony!</title>
  </head>
  <body>
    <h1>{{ page_title }}</h1>

    {% if user.isLoggedIn %} Hello {{ user.name }}! {% endif %} {# ... #}
  </body>
</html>
```

<hr>

### JSON & Data

> ChatController.php

:pushpin: Data is imported from the public folder at './'

```php
$chatList = file_get_contents('./data/conversation.json');
$json = json_decode($chatList, true);
foreach ($json['messages'] as $key => $value) {
}
return $this->render('chat/index.html.twig', array('json' => $json));
```

> chat/index.html.twig

Working with data in Twig template:

```php
{% if json %}
<div class="chatWindow">
  {% for item in json['messages'] %}
  <div class="message m-3">
    <div class="row">
      <div class="bubble col-6">
        <p>{{ item['msg'] }}</p>
      </div>
    </div>
  </div>
  {% endfor %}
</div>
{% else %}
<p>No messages to display.</p>
{% endif %}
```

<hr>

### Services

> Your application is full of useful objects: a "Mailer" object might help you send emails while another object might help you save things to the database. Almost everything that your app "does" is actually done by one of these objects. And each time you install a new bundle, you get access to even more!

> In Symfony, these useful objects are called services and each service lives inside a very special object called the service container. The container allows you to centralize the way objects are constructed. It makes your life easier, promotes a strong architecture and is super fast!

Read more about [services](https://symfony.com/doc/current/service_container.html).

Example:

> src/Service/Name.php

```php
namespace App\Service;

class MessageGenerator
{
  public function getHappyMessage()
  {
    $messages = [
      'You did it! You updated the system! Amazing!',
      'That was one of the coolest updates I\'ve seen all day!',
      'Great work! Keep going!',
    ];

    $index = array_rand($messages);

    return $messages[$index];
  }
}
```

> src/Controller/Name.php

```php
use App\Service\MessageGenerator;

//....

echo MessageGenerator::getHappyMessage();
```

<hr>

### Console

> The Console component allows you to create command-line commands. Your console commands can be used for any recurring task, such as cronjobs, imports, or other batch jobs.

Read more about the [console](https://symfony.com/doc/current/console.html);

> src/Command/ChatCommand.php

Example:

```php
// src/Command/CreateUserCommand.php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:create-user';

    protected function configure()
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ...

        return 0;
    }
}
```

## :man_technologist: Author

- **Austin** - [austinbuilds](https://github.com/austinbuilds)
