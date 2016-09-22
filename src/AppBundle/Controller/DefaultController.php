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
        $marksFilter = $this->get('mark.filter');
        $currentWeek = $marksFilter->getCurrentWeek();

        $form = $this->createForm(MarkFilterType::class, null, [
            'motherId' => $motherId,
            'weekStart' => $currentWeek,
        ]);

        // Get marks by route and form parameters
        $form->handleRequest($request);
        $marks = $marksFilter->getMarks($motherId, $subjectId, $form);

        $subject = $marksFilter->getSubject();
        $mother = $this->getDoctrine()->getRepository('AppBundle:Mother')->find($motherId);

        return $this->render('default/marks.html.twig', [
            'week' => $currentWeek,
            'mother' => $mother,
            'marks' => $marks,
            'subject' => $subject,
            'filterForm' => $form->createView()
        ]);
    }
}
