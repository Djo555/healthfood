<?php


namespace App\Controller;


use App\Classe\Cart;

use App\Entity\Product;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Attribute\Route;


class CartController extends AbstractController

{

    #[Route('/add-to-cart/{id}', name: 'add_to_cart', methods: ['POST'])]

    public function addToCart($id, Cart $cart, EntityManagerInterface $entityManager ): Response

    {

        // Récupérer le produit à partir de son ID

        $product = $entityManager->getRepository(Product::class)->find($id);


        if (!$product) {

            throw $this->createNotFoundException('Produit non trouvé.');

        }


        // Ajouter le produit au panier

        $cart->add($product);


        $this->addFlash('success', 'Produit ajouté au panier.');

       

        // Rediriger vers la page boutique

        return $this->redirectToRoute('boutique');

    }




    #[Route('/cart', name: 'cart')]

    public function index(Cart $cart): Response

    {

        // Récupérer le panier

        $cartItems= $cart->getCart();


        $totalPrice = $cart->getTotalPrice();

        $totalQuantity = $cart->getTotalQuantity();


        return $this->render('boutique/cart.html.twig', [

            'cart' => $cartItems,

            'totalPrice' => $totalPrice,

            'totalQuantity' => $totalQuantity

        ]);

    }


    #[Route('/remove-from-cart/{id}', name: 'remove_from_cart')]

    public function removeFromCart($id, Cart $cart, EntityManagerInterface $entityManager ): Response

    {

    // Récupérer le produit à partir de son ID

        $product = $entityManager->getRepository(Product::class)->find($id);


        if (!$product) {

            throw $this->createNotFoundException('Produit non trouvé.');

        }

        $cart->remove($product);


        // Ajouter un message flash de succès

        $this->addFlash('success', 'Produit retiré du panier.');


        // Rediriger vers la page panier

        return $this->redirectToRoute('cart');

    }

}