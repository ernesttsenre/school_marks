<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\MarkFilterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function indexAction()
    {
        $mothers = $this->getDoctrine()
            ->getRepository('AppBundle:Mother')
            ->findAll();

        return $this->render('/default/index.html.twig', [
            'mothers' => $mothers
        ]);
    }

    /**
     * @param Request $request
     * @param int $motherId
     * @param int $subjectId
     *
     * @Route("/marks/{motherId}", name="marks_page", requirements={"motherId": "\d+"})
     * @Route("/marks/{motherId}/{subjectId}", name="marks_by_subject_page", requirements={"motherId": "\d+"})
     * @return Response
     */
    public function marksAction(Request $request, $motherId, $subjectId = null)
    {
        $week = new \DateTime('monday this week');

        // Форма для фильтрации по предметам
        $form = $this->createForm(MarkFilterType::class, null, [
            'motherId' => $motherId,
            'weekStart' => $week
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $filterMark = $form->get('filter')->getData();
            if ($filterMark) {
                $subjectId = $filterMark->getSubject()->getId();
            }
        }

        // Оценки детей отфильтрованные по родителю и предмету
        $marks = $this->getDoctrine()
            ->getRepository('AppBundle:Mark')
            ->findByParentsAndSubject($week, $motherId, $subjectId);

        // Если фильтровался предмет, то он тоже нужен в виде
        $subject = null;
        if (!is_null($subjectId)) {
            $subject = $this->getDoctrine()->getRepository('AppBundle:Subject')->find($subjectId);
        }

        // Родитель, чтобы знать, каких детей искать
        $mother = $this->getDoctrine()->getRepository('AppBundle:Mother')->find($motherId);

        return $this->render('default/marks.html.twig', [
            'week' => $week,
            'mother' => $mother,
            'marks' => $marks,
            'subject' => $subject,
            'filterForm' => $form->createView()
        ]);
    }
}
