<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarkFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filter', EntityType::class, [
                'class' => 'AppBundle:Mark',
                'choice_value' => 'subject.id',
                'choice_label' => 'subject.title',
                'label' => 'Предмет',
                'placeholder' => 'Выберите предмет',
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('mark')
                        ->join('mark.learner', 'learner', 'WITH', 'learner.parents = :parents_id')
                        ->join('mark.subject', 'subject')
                        ->where('mark.created >= :week_start')
                        ->setParameters([
                            'parents_id' => $options['parentsId'],
                            'week_start' => $options['weekStart']
                        ])
                        ->orderBy('subject.created')
                        ->groupBy('subject.id');
                },
            ])
            ->add('apply', SubmitType::class, [
                'label' => 'Применить'
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'parentsId' => null,
            'weekStart' => new \DateTime()
        ));
    }
}
