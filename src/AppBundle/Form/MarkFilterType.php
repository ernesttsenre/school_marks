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
                'label' => 'subject.label',
                'placeholder' => 'subject.placeholder',
                'translation_domain' => 'forms',
                'required' => false,
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('mark')
                        ->join('mark.learner', 'learner', 'WITH', 'learner.mother = :motherId')
                        ->join('mark.subject', 'subject')
                        ->where('mark.created >= :weekStart')
                        ->setParameters([
                            'motherId' => $options['motherId'],
                            'weekStart' => $options['weekStart']
                        ])
                        ->orderBy('subject.created')
                        ->groupBy('subject.id');
                },
            ])
            ->add('apply', SubmitType::class, [
                'label' => 'apply.label',
                'translation_domain' => 'forms',
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'motherId' => null,
            'weekStart' => new \DateTime()
        ));
    }
}
