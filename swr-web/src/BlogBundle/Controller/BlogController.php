<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Likes;
use BlogBundle\Entity\Posts;
use BlogBundle\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Doctrine\UserManager;
use BlogBundle\Form\PostsType;
use PaginatorBundle\KnpPaginatorBundle\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Snipe\BanBuilder\CensorWords;

class BlogController extends Controller
{
    public function showAction()
    {
        return $this->render('@Blog/Posts/BlogF.html.twig');
    }
    public function showLoginAction()
    {
        return $this->render('@Blog/Login/Login.html.twig');
    }

    public function showPAction(Request $rq)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        $userManager = $this->get('fos_user.user_manager');
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $what = $this->getDoctrine()->getRepository(Posts::class)->who($user->getId());
            $int=(integer)(implode($what[0]));

        }
        else{$what ="0";}



        $posts = new Posts();
        $form = $this->createForm(PostsType::class, $posts);
        $form = $form->handleRequest($rq);
        if ($form->isSubmitted()) {


            if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
                if ($int ==6){
                    $userManager->deleteUser($user);
                    return $this->redirectToRoute('fos_user_security_login');
                }


                $censor = new CensorWords;
            $em = $this->getDoctrine()->getManager();
            $file= $posts->getImgpost();
            $random = random_int(1, 10);
            if(is_null ( $file ) ){
                $posts->setImgpost($random.'.jpg');
            }
            else{
            $filename= md5(uniqid()) . '.' . $file->guessExtension();;
            $file->move($this->getParameter('image_upload'), $filename);
            $posts->setImgpost($filename);
        }
            $censor->setDictionary("C:/wamp64/www/swr-web/web/uploads/dictionary.php");

            $string = $censor->censorString($posts->getContenup());
                if($string['clean']!=$string['orig'])
                { $posts->setReport(1);}

            $posts->setContenup($string['clean']);
            $posts->setDatep(new \DateTime('now'));

            $posts->setIduser($user->getId());

            $em->persist($posts);
            $em->flush();
            return $this->redirectToRoute('blog_showPosts');


            }
        elseif ($securityContext->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')){
            return $this->redirectToRoute('fos_user_security_login');
        }
        }


        $posts = $this->getDoctrine()->getRepository(Posts::class)->findAll();
        $paginator=$this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts, /* query NOT result */
            $rq->query->getInt('page', 1), /*page number*/
            9 /*limit per page*/
        );
      $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render('@Blog/Posts/BlogF.html.twig', array('posts' => $pagination,'users' => $users,'user'=>$user, "Form"=> $form->createView(),'count'=>$what));
    }


    public function deletePostAction(Request $rq,$id)
    {  $ref = $rq->headers->get('referer');
        $em = $this->getDoctrine()->getManager();
        $posts = $this->getDoctrine()->getRepository(Posts::class)->find($id);
        $cmt = $this->getDoctrine()->getRepository(Comments::class)->find($posts->getIdp());
        $em->remove($posts);
        $em->flush();
        return $this->redirect($ref);
    }

    public function updateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $posts=$em->getRepository(Posts::class)->find($id);

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        if ($request->isMethod('POST'))
        {
            $censor = new CensorWords;
            $censor->setDictionary("C:/wamp64/www/swr-web/web/uploads/dictionary.php");

            $string = $censor->censorString($request->get('contenup'));

            $posts->setContenup($string['clean']);

            $em->flush();
            return $this->redirectToRoute('blog_showPosts');
        }
        return $this->render('@Blog/Posts/Postupdate.html.twig', array('posts'=>$posts,'user'=>$user));
    }

    public  function createPAction(Request $rq){

        $posts = new Posts();
        $form = $this->createForm(PostsType::class, $posts);
        $form = $form->handleRequest($rq);
        if ($form->isSubmitted()) {
            /**
             * @var UploadedFile $file
             */
            $em = $this->getDoctrine()->getManager();
            $file= $posts->setImgpost();
            $filename= md5(uniqid()) . '.' . $file->guessExtension();;
            $file->move($this->getParameter('image_upload'), $filename);
            $posts->setDatep(new \DateTime('now'));
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $posts->setIduser($user->getId());

            $em->persist($posts);
            $em->flush();
            return $this->redirectToRoute('blog_showPosts');}


        /*
        if($rq->request->get('save')){
            $posts = new Posts();
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $posts->setIduser($user->getId());

          //  $info = getimagesize($rq->request->get('imgpost'));
           // $extension = image_type_to_extension($info[2]);
            //$posts->setImgpost($rq->get('imgpost'));
            //$file = $rq->request->get('imgpost');
           // $filename= md5(uniqid()) . '.' . $extension;
           // $file->move($this->getParameter('image_upload'), $filename);*/
           /* $posts->setImgpost($rq->get('imgpost'));
          //
            $posts->setContenup($rq->get('contenup'));
            $posts->setDatep(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($posts);
            $em->flush();
            return $this->redirectToRoute('blog_showPosts');
        }*/
       # return $this->render('@Blog/Posts/DetailsPost.html.twig');
    }


    public function showDetailAction($id)
    {

        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
        $posts = $this->getDoctrine()->getRepository(Posts::class)->find($id);
        $repository=$this->getDoctrine()->getManager()->getRepository(Comments::class);
        $hot = $this->getDoctrine()->getRepository(Posts::class)->hot();
        $userManager = $this->get('fos_user.user_manager');
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $userManager->findUsers();
        $posts->setViews( $posts->getViews()+1);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $cmt = $repository->findComments($id) ;
        return $this->render('@Blog/Posts/DetailsPost.html.twig', array('posts' => $posts,'cmt' => $cmt,'users' => $users,'hot' => $hot,'user' => $user));}
        elseif ($securityContext->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')){
            return $this->redirectToRoute('fos_user_security_login');
        }
    }





 // *****************************      Comments  ****************************************

    public function showCtAction($id)
    {

        $repository=$this->getDoctrine()->getManager()->getRepository(Comments::class);
        $cmt = $repository->findComments($id) ;
        return $this->render('@Blog/Posts/DetailsPost.html.twig', array('cmt' => $cmt));


    }



    public  function createCAction(Request $rq){


        $ref = $rq->headers->get('referer');



        if($rq->request->get('submit')){
            $securityContext = $this->container->get('security.authorization_checker');
            if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            $cmt = new Comments();
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $cmt->setIduser($user->getId());
                $censor = new CensorWords;
                $censor->setDictionary("C:/wamp64/www/swr-web/web/uploads/dictionary.php");
                $string = $censor->censorString($rq->get('comment'));
            $cmt->setContenuc($string['clean']);
            $cmt->setDatec(new \DateTime('now'));
            $id=$rq->get('idpp');
            $cmt->setIdp($id);
            $post = $this->getDoctrine()->getRepository(Posts::class)->find($id);
            $post->setNbcmt( $post->getNbcmt()+1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($cmt);
            $em->flush();
            }
            elseif ($securityContext->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')){
                return $this->redirectToRoute('fos_user_security_login');
            }

        }
        return $this->redirect($ref);
        # return $this->render('@Blog/Posts/DetailsPost.html.twig');
    }

    public function deleteCmtAction(Request $rq,$id)
    {
        $ref = $rq->headers->get('referer');

        $em = $this->getDoctrine()->getManager();
        $cmt = $this->getDoctrine()->getRepository(Comments::class)->find($id);
        $post = $this->getDoctrine()->getRepository(Posts::class)->find($cmt->getIdp());
        $post->setNbcmt( $post->getNbcmt()-1);
        $em->remove($cmt);
        $em->flush();
        #return $this->redirectToRoute('blog_showPosts');
        return $this->redirect($ref);

    }

    public function updateCAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $cmt=$em->getRepository(Comments::class)->find($id);


        if ($request->isMethod('POST'))
        {
            $cmt->setContenup($request->get('contenuc'));

            $em->flush();
            return $this->redirectToRoute('blog_showPosts');
        }
        return $this->render('@Blog/Posts/Cmtupdate.html.twig', array('$cmt'=>$cmt));
    }


    // *****************************      LIKES      ****************************************

    public  function likeAction(Request $rq,$id){
        $like =new Likes();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $posts = $this->getDoctrine()->getRepository(Posts::class)->find($id);
        $checkk = $this->getDoctrine()->getRepository(Likes::class)->check($id,$user->getId());
        $em=$this->getDoctrine()->getManager();
    //    $likes=$em->getRepository(Likes::class)->find($id);

            if (empty($checkk)) {
                $like->setIdp($id);
                $like->setIduser($user->getId());
                $posts->setLikes($posts->getLikes() + 1);
                $em->persist($like);
                $em->flush();

            } else {
               // $this->deleteLikespAction($rq, $like->setIdp());


                $like = $this->getDoctrine()->getRepository(Likes::class)->findOneBy(['idl'=>$checkk[0]]);
                $em->remove($like);

                $posts->setLikes($posts->getLikes() - 1);
                $em->flush();
            }


        return $this->redirectToRoute('blog_showPosts');

    }
    public function deleteLikespAction(Request $rq,$id)
    {
        $ref = $rq->headers->get('referer');

        $em = $this->getDoctrine()->getManager();
        $like = $this->getDoctrine()->getRepository(Likes::class)->find($id);
        $em->remove($like);
        $em->flush();
        return $this->redirect($ref);

    }





    // *****************************      BACK      ****************************************


    public function showPBAction(Request $rq,$id)
    {

      /*  $e = $this->getDoctrine()->getManager();
        $queryBuilder=$e->getRepository('BlogBundle:Posts')->createQueryBuilder(p);

            $queryBuilder
                ->where('p.contenup LIKE :contenu')
                ->setParameter('contenu', '%' . $rq->query->getAlnum('filter') . '%');
*/

        if($id == 'null'){

            $paginator=$this->get('knp_paginator');




                  $posts = $this->getDoctrine()->getRepository(Posts::class)->findAll();
            $pagination = $paginator->paginate(
                $posts, /* query NOT result */
                $rq->query->getInt('page1', 1),
                5 ,['pageParameterName' => 'page1']
            );
            $cmt = $this->getDoctrine()->getRepository(Comments::class)->findAll();
            $paginationC = $paginator->paginate(
                $cmt,
                $rq->query->getInt('page2', 1),
                5,['pageParameterName' => 'page2']
            );
            return $this->render('@Blog/Posts/PostsBack.html.twig',array('posts' => $pagination,'cmt' => $paginationC));
        }
        else{
            $paginator=$this->get('knp_paginator');


            $posts = $this->getDoctrine()->getRepository(Posts::class)->findAll();


            $pagination = $paginator->paginate(
                $posts, /* query NOT result */
                $rq->query->getInt('page1', 1), /*page number*/
                5 ,['pageParameterName' => 'page1']
            );
            $repository=$this->getDoctrine()->getManager()->getRepository(Comments::class);
            $cmt = $repository->findComments($id) ;
            $paginationC = $paginator->paginate(
                $cmt,
                $rq->query->getInt('page2', 1),
                5,['pageParameterName' => 'page2']
            );
            return $this->render('@Blog/Posts/PostsBack.html.twig',array('posts' => $pagination,'cmt' => $paginationC));
        }
    }







}
