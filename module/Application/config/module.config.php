<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014-2016 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace Application;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => 'Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'console' => [
        'router' => [
            'routes' => [
                'debug' => [
                    'type' => 'simple',
                    'options' => [
                        'route' => 'debug',
                        'defaults' => [
                            'controller' => Controller\IndexController::class,
                            'action' => 'debug',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\IndexControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'invokables' => [
            \Application\Doctrine\Hydrator\Strategy\DateTimeExtractStrategy::class,
        ],
        'factories' => [
            'SparkPost' => Service\SparkPostFactory::class,
            'Mailgun' => Service\MailgunFactory::class,
            Service\Mailer::class => Service\MailerFactory::class,
        ],
    ],
    'view_manager' => [
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
