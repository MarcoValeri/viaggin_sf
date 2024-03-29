<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Author;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Document;
use App\Entity\Image;
use App\Entity\Tag;

use App\Repository\ArticleRepository;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository) {
        $this->articleRepository = $articleRepository;
    }


    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        
        $articles = $this->articleRepository->findAll();

        return $this->render('admin/dashboard.html.twig', [
            'articles' => $articles
        ]);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Viaggin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Back to the website', 'fas fa-home', $this->generateUrl('app_home'));
        yield MenuItem::linktoDashboard('Dashboard', 'fas fa-solar-panel');
        yield MenuItem::section('Content');
        yield MenuItem::linkToCrud('Articles', 'fas fa-newspaper', Article::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-images', Image::class);
        yield MenuItem::linkToCrud('Documents', 'fa fa-files-o', Document::class);
        yield MenuItem::linkToCrud('Categories', 'far fa-newspaper', Category::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-tags', Tag::class);
        yield MenuItem::section('Authors');
        yield MenuItem::linkToCrud('Authors', 'fa fa-pen', Author::class);
        yield MenuItem::section('Users');
        yield MenuItem::linkToUrl('Create User', 'fa-solid fa-face-smile', $this->generateUrl('app_registration_user'));
        yield MenuItem::linkToUrl('Edit Users', 'fa-solid fa-users', $this->generateUrl('app_admin_users'));
        yield MenuItem::section('Comments');
        yield MenuItem::linkToCrud('Comments', 'fa fa-comment', Comment::class);
    }

    /**
     * Show details to any field
     */
    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}