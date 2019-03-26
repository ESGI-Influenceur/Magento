<?php
// app/code/Esgi/Helloworld/Block/Hello.php
namespace Esgi\Helloworld\Block;

/**
 * Hello block
 */
class Hello extends \Magento\Framework\View\Element\Template
{
    /**
     * @param $name
     * @return string
     */
    public function hello($name)
    {
        return 'Hello ' . $name;
    }
}
