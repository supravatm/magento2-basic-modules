<?php

declare(strict_types=1);

namespace SMG\CustomRoute\Controller;

use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterInterface;

class SpecialRouter implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    private $actionFactory;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * Router constructor.
     *
     * @param ActionFactory $actionFactory
     * @param ResponseInterface $response
     */
    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response
    ) {
        $this->actionFactory = $actionFactory;
        $this->response = $response;
    }

    private const SYMBOL_TO_NAME_MAP = [
        [
            'symbol' => '-',
            'name' => 'dash',
        ],
        [
            'symbol' => '.',
            'name' => 'period',
        ],
        [
            'symbol' => '~',
            'name' => 'tilda',
        ],
        [
            'symbol' => '_',
            'name' => 'underscore',
        ],
    ];
    /**
     * @inheritDoc
     */
    public function match(RequestInterface $request): ? ActionInterface
    {
        $identifier = trim($request->getPathInfo(), '/');
        //dd($request->getParams());
        $pathParts = explode('/', $identifier);
        $moduleName = array_shift($pathParts);
        $pathInfo = implode('/', $pathParts);
        
        if ($this->isMatch($pathInfo)) {
            $newpathInfo = $this->replacePath($pathInfo);
            $newpathParts= explode('/', $newpathInfo);
            $controllerName = current($newpathParts);
            $actionName = end($newpathParts);

            $request->setModuleName($moduleName);
            $request->setControllerName($controllerName);
            $request->setActionName($actionName);
            
            return $this->actionFactory->create(Forward::class, ['request' => $request]);
        }
        return null;
    }

    /**
     * Does the path contain a character in the symbol to name map?
     *
     * @param string $pathInfo
     * @return bool
     */
    private function isMatch(
        string $pathInfo,
    ): bool {
        foreach (self::SYMBOL_TO_NAME_MAP as $item) {
            if (str_contains($pathInfo, $item['symbol'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * Replace special characters in the path with their names.
     *
     * @param string $pathInfo
     * @return string
     */
    private function replacePath(
        string $pathInfo,
    ): string {
        foreach (self::SYMBOL_TO_NAME_MAP as $item) {
            $pathInfo = str_replace($item['symbol'], $item['name'], $pathInfo);
        }

        return $pathInfo;
    }
}
