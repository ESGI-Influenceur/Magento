<?php
// app/code/Esgi/Helloworld/Controller/Index/Understand.php
namespace Esgi\Helloworld\Controller\Index;

class Understand extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        echo 'THIS IS UNDERSTAND PAGE';
        die();
    }
}
