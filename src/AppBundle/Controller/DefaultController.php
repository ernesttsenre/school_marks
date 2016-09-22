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
     *
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
     * @param string $order
     *
     * @Route("/marks/{motherId}", name="marks_page", requirements={"motherId": "\d+"})
     * @Route("/marks/{motherId}/{order}", name="marks_page_sort",
     *     requirements={"motherId": "\d+", "order": "asc|desc"})
     *
     * @return Response
     */
    public function marksAction(Request $request, $motherId, $order = 'asc')
    {
        $currentWeek = new \DateTime('monday this week');

        $marks = $this->getDoctrine()
            ->getRepository('AppBundle:Mark')
            ->findByParentsAndSubject($currentWeek, $motherId, $order);

        $mother = $this->getDoctrine()->getRepository('AppBundle:Mother')->find($motherId);

        return $this->render('default/marks.html.twig', [
            'week' => $currentWeek,
            'mother' => $mother,
            'marks' => $marks,
            'order' => $order
        ]);
    }
}
