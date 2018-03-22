<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ville')->add('adresse')->add('codePostal')->add('loyerCcM')->add('charges')->add('balcon')->add('surfaceTot')->add('anneeConst')->add('etage')->add('nbPiece')->add('nbChambre')->add('toilette')->add('cuisineEquipee')->add('meuble')->add('nbParking')->add('interphone')->add('ascenseur')->add('normesAndicap')->add('description');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Location'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_location';
    }


}
