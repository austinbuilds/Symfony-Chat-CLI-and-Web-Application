<?php
  namespace App\Controller;

  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  // Redirect
  use Symfony\Component\HttpFoundation\RedirectResponse;
  // Services
  use App\Service\AddMessage;

  class ChatController extends AbstractController {

    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index() {
      // Data -> conversation.json
      $chatList = file_get_contents('./data/conversation.json');
      $json = json_decode($chatList, true);
      foreach ($json['messages'] as $key => $value) {
      }

      return $this->render('chat/index.html.twig', array('json' => $json));
    }

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

    /**
     * @Route("/about", name="about", methods={"GET"})
     */
    public function about() {
      // Render
      return $this->render('about/index.html.twig');
    }
}