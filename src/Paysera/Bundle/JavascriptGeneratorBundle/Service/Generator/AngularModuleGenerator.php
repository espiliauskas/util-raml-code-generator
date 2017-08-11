<?php
declare(strict_types=1);

namespace Paysera\Bundle\JavascriptGeneratorBundle\Service\Generator;

use Paysera\Bundle\CodeGeneratorBundle\Service\Generator\GeneratorInterface;
use Paysera\Bundle\CodeGeneratorBundle\Entity\Definition\ApiDefinition;
use Paysera\Bundle\CodeGeneratorBundle\Entity\SourceCode;
use Symfony\Component\Templating\EngineInterface;

class AngularModuleGenerator implements GeneratorInterface
{
    private $twig;
    private $sourceDir;

    public function __construct(
        EngineInterface $twig,
        string $sourceDir
    ) {
        $this->twig = $twig;
        $this->sourceDir = $sourceDir;
    }

    public function generate(ApiDefinition $definition) : array
    {
        $code = $this->twig->render(
            'PayseraJavascriptGeneratorBundle:Package/Src:AngularModule.js.twig',
            [
                'api' => $definition
            ]
        );

        $item = (new SourceCode())
            ->setFilepath('src/angular.module.js')
            ->setContents($code)
        ;

        return [$item];
    }
}
