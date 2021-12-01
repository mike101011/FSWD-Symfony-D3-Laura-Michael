<?php

namespace App\Controller;

use App\Entity\Contacts;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function createContact(Request $request): Response
    {
        $contact = new Contacts();
        $form = $this->createFormBuilder($contact)->add('f_name', TextType::class, array('label' => 'First Name', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('l_name', TextType::class, array('label' => 'Surame', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('gender', ChoiceType::class, array('choices' => array('Male' => 'Male', 'Female' => 'Female'), 'label' => 'Gender', 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('b_date', DateType::class, array('label' => 'Birth date', 'attr' => array('style' => 'margin-bottom:15px')))
            ->add('message', TextareaType::class, array('label' => 'Your message', 'attr' => array('class' => 'form-control', 'style' => 'margin-botton:15px')))
            ->add('submit', SubmitType::class, array('label' => 'Send message', 'attr' => array('class' => 'btn-primary', 'style' => 'margin-botton:15px')))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $f_name = $form['f_name']->getData();
            $l_name = $form['l_name']->getData();
            $gender = $form['gender']->getData();
            $b_date = $form['b_date']->getData();
            $message = $form['message']->getData();

            $contact->setFName($f_name);
            $contact->setLName($l_name);
            $contact->setGender($gender);
            $contact->setBDate($b_date);
            $contact->setMessage($message);

            $em = $this->getDoctrine()->getManager();

            $em->persist($contact);

            $em->flush();

            $this->addFlash(

                'notice',

                'Contact Added'

            );

            return $this->redirectToRoute('book');
        }
        return $this->render('contact/index.html.twig', array('form' => $form->createView()));
    }
}
