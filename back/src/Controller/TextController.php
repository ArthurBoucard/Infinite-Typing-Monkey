<?php

namespace App\Controller;

use App\Entity\BasicText;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class TextController extends AbstractController
{
    #[Route('/text', name: 'add_text', methods: ['POST'])]
    public function addText(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);

        if (empty($body['content'])) {
            return $this->json([
                'message' => 'Content is required',
            ], 400);
        }

        $text = new BasicText();
        $text->setContent($body['content']);
        $text->setTimestamp(time());

        $em->persist($text);
        $em->flush();

        return $this->json([
            'message' => 'Text added',
        ], 201);
    }
    #[Route('/text', name: 'get_all_text', methods: ['GET'])]
    public function getAllText(EntityManagerInterface $em): JsonResponse
    {
        $texts = $em->getRepository(BasicText::class)->findAll();

        $data = [];

        foreach ($texts as $text) {
            $data[] = [
                'id' => $text->getId(),
                'content' => $text->getContent(),
                'timestamp' => $text->getTimestamp(),
            ];
        }

        return $this->json($data);
    }

    #[Route('/text/{id}', name: 'get_text', methods: ['GET'])]
    public function getText(EntityManagerInterface $em, int $id): JsonResponse
    {
        $text = $em->getRepository(BasicText::class)->find($id);

        if (!$text) {
            return $this->json([
                'message' => 'Text not found',
            ], 404);
        }

        return $this->json([
            'content' => $text->getContent(),
            'timestamp' => $text->getTimestamp(),
        ]);
    }
}
