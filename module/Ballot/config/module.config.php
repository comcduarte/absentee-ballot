<?php 

use Ballot\Controller\BallotController;
use Ballot\Controller\ConfigController;
use Ballot\Controller\Factory\BallotControllerFactory;
use Ballot\Controller\Factory\ConfigControllerFactory;
use Ballot\Form\BallotForm;
use Ballot\Form\Factory\BallotFormFactory;
use Ballot\Service\Factory\BallotModelPrimaryAdapterFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Ballot\Controller\ReasonController;
use Ballot\Controller\Factory\ReasonControllerFactory;
use Ballot\Form\ReasonForm;
use Ballot\Form\Factory\ReasonFormFactory;

return [
    'router' => [
        'routes' => [
            'ballots' => [
                'type' => Literal::class,
                'priority' => 1,
                'options' => [
                    'route' => '/ballots',
                    'defaults' => [
                        'action' => 'index',
                        'controller' => BallotController::class,
                    ],
                ],
                'may_terminate' => TRUE,
                'child_routes' => [
                    'config' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/config[/:action]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => ConfigController::class,
                            ],
                        ],
                    ],
                    'default' => [
                        'type' => Segment::class,
                        'priority' => -100,
                        'options' => [
                            'route' => '/[:action[/:uuid]]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => BallotController::class,
                            ],
                        ],
                    ],
                ],
            ],
            'reasons' => [
                'type' => Literal::class,
                'priority' => 1,
                'options' => [
                    'route' => '/reasons',
                    'defaults' => [
                        'action' => 'index',
                        'controller' => ReasonController::class,
                    ],
                ],
                'may_terminate' => TRUE,
                'child_routes' => [
                    'default' => [
                        'type' => Segment::class,
                        'priority' => -100,
                        'options' => [
                            'route' => '/[:action[/:uuid]]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => ReasonController::class,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'acl' => [
        'guest' => [
            
        ],
        'member' => [
            
        ],
    ],
    'controllers' => [
        'factories' => [
            BallotController::class => BallotControllerFactory::class,
            ConfigController::class => ConfigControllerFactory::class,
            ReasonController::class => ReasonControllerFactory::class,
        ],
    ],
    'form_elements' => [
        'factories' => [
            BallotForm::class => BallotFormFactory::class,
            ReasonForm::class => ReasonFormFactory::class,
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Ballots',
                'route' => 'ballots',
                'class' => 'dropdown',
                'pages' => [
                    [
                        'label' => 'Issue Ballot',
                        'route' => 'ballots/default',
                        'action' => 'create'
                    ],
                    [
                        'label' => 'Search Ballots',
                        'route' => 'ballots/default',
                        'action' => 'search',
                    ],
                    [
                        'label' => 'View Ballots',
                        'route' => 'ballots/default',
                        'action' => 'index',
                    ],
                    [
                        'label' => 'Settings',
                        'route' => 'ballots/config',
                    ],
                ],
            ],
            [
                'label' => 'Table Maintenance',
                'route' => 'home',
                'class' => 'dropdown',
                'pages' => [
                    [
                        'label' => 'Reasons',
                        'route' => 'reasons/default',
                        'class' => 'dropdown-submenu',
                        'pages' => [
                            [
                                'label' => 'Add New Reason',
                                'route' => 'reasons/default',
                                'action' => 'create'
                            ],
                            [
                                'label' => 'List Reasons',
                                'route' => 'reasons/default',
                                'action' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'ballot-model-primary-adapter-config' => 'model-primary-adapter-config',
        ],
        'factories' => [
            'ballot-model-primary-adapter' => BallotModelPrimaryAdapterFactory::class,
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'functions' => Functions::class,
        ],
        'factories' => [
            Functions::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];