<?php

namespace PainelGetNet\AppBundle\Form\GetNet\Report\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaymentsReportType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start_date', 'date', [
                'label' => 'De',
                'widget' => 'single_text',
                'horizontal' => false,
                'widget_form_group_attr' => [
                    'class' => 'col-sm-6'
                ],
                'attr' => [
                    'title' => 'Data inicial'
                ]
            ])
            ->add('end_date', 'date', [
                'label' => 'Até',
                'widget' => 'single_text',
                'horizontal' => false,
                'widget_form_group_attr' => [
                    'class' => 'col-sm-6 '
                ],
                'attr' => [
                    'title' => 'Data final'
                ]
            ])
            ->add('buscar', 'submit', array(
                'attr' =>[
                    'class' => 'btn-primary pull-right',
                    'title' => 'Buscar pagamentos'
                ]
            ))
            ->setMethod('GET');
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'action' => ''
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'painelgetnet_appbundle_getnet_payments_report';
    }
}
