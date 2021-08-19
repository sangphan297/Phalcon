<?php
// namespace App\Controllers;
declare(strict_types=1);
use Phalcon\Mvc\View;
use Phalcon\Http\Request;
use App\Models\Users;
use App\Models\Companys;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray; 

class IndexController extends ControllerBase
{
    public function indexAction()
    {
        //relationship
        // $user = Users::findFirst(2);
        // $company = $user->companys;
        // echo "<pre>";
        // echo print_r($company->toArray());
        // echo "</pre>";
        // die();
        // $company = Companys::findFirst(1);
        // $users = $company->getUsers();
        // echo "<pre>";
        // echo print_r($company->toArray());
        // echo "</pre>";
        // die();
        $user_id = 3;
        $users = $this->modelsManager
                    ->createBuilder()
                    ->from(['users' => Users::class])
                    ->join(Companys::class, 'users.company_id = companys.company_id', 'companys')
                    // ->where(
                    //     "id = :user_id:",
                    //     [
                    //         "user_id" => $user_id
                    //     ]
                    // )
                    ->columns([
                        // Fetching only desired columns (prefered way)
                        'users.id',
                        'users.name',
                        'users.email',
                        'companys.company_name',
                        // Or fetching whole objects
                        // 'users.*',
                        // 'companys.*',    
                    ])
                    ->orderBy('name')
                    ->getQuery()
                    ->execute();
        echo "<pre>";
        echo print_r($users->toArray());
        echo "</pre>";
        die();
        // Create a Model paginator, show 10 rows by page starting from $currentPage
        $currentPage = 1;
        $paginator = new PaginatorArray(
            [
                'data'  => $users->toArray(),
                'limit' => 10,
                'page'  => $currentPage,
            ]
        );
        $paginate = $paginator->paginate();
        echo "<pre>";
        echo print_r($paginate->getItems()); 
        echo "</pre>";
        die();
        return $this->view->setVar('user', $user)->pick('layouts/test');
    }

    public function uploadAction()
    {
        $files = $this->request->getUploadedFiles();
        print_r($this->request->getPost('upload'));
            // Print the real file names and sizes
            foreach ($files as $file) {
                // Print file details
                echo $file->getName(), ' ', $file->getSize(), '\n';

                // Move the file into the application
                $file->moveTo(
                    'files/' . $file->getName()
                );
            }
        // Check if the user has uploaded files
        // if ($this->request->hasFiles()) {
        //     $files = $this->request->getUploadedFiles();
        //     echo "abc";
        //     // Print the real file names and sizes
        //     foreach ($files as $file) {
        //         // Print file details
        //         echo $file->getName(), ' ', $file->getSize(), '\n';

        //         // Move the file into the application
        //         $file->moveTo(
        //             'files/' . $file->getName()
        //         );
        //     }
        // }else{
        //     echo "Không";
        // }
    }

}

