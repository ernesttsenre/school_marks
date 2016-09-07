<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Form\MarkFilterType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/marks/{parents_id}", name="marks_page", requirements={"parents_id": "\d+"})
     * @Route("/marks/{parents_id}/{subject_id}", name="marks_by_subject_page", requirements={"parents_id": "\d+"})
     */
    public function marksAction(Request $request, $parents_id, $subject_id = null)
    {
        $week = new \DateTime('monday this week');

        // Форма для фильтрации по предметам
        $form = $this->createForm(MarkFilterType::class, null, [
            'parentsId' => $parents_id,
            'weekStart' => $week
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $filterMark = $form->get('filter')->getData();
            if ($filterMark) {
                $subject_id = $filterMark->getSubject()->getId();
            }
        }

        // Оценки детей отфильтрованные по родителю и предмету
        $marks = $this->getDoctrine()->getRepository('AppBundle:Mark')->findByParentsAndSubject($week, $parents_id, $subject_id);

        // Если фильтровался предмет, то он тоже нужен в виде
        $subject = null;
        if (!is_null($subject_id)) {
            $subject = $this->getDoctrine()->getRepository('AppBundle:Subject')->find($subject_id);
        }

        // Родитель, чтобы знать, каких детей искать
        $parents = $this->getDoctrine()->getRepository('AppBundle:Parents')->find($parents_id);

        return $this->render('default/marks.html.twig', [
            'week' => $week,
            'parents' => $parents,
            'marks' => $marks,
            'subject' => $subject,
            'filterForm' => $form->createView()
        ]);
    }
}
