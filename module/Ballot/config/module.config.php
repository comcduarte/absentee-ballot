<?php 

use Ballot\Controller\BallotController;
use Ballot\Controller\ConfigController;
use Ballot\Controller\DistributionController;
use Ballot\Controller\DistrictController;
use Ballot\Controller\PartyController;
use Ballot\Controller\ReasonController;
use Ballot\Controller\Factory\BallotControllerFactory;
use Ballot\Controller\Factory\ConfigControllerFactory;
use Ballot\Controller\Factory\DistributionControllerFactory;
use Ballot\Controller\Factory\DistrictControllerFactory;
use Ballot\Controller\Factory\PartyControllerFactory;
use Ballot\Controller\Factory\ReasonControllerFactory;
use Ballot\Form\BallotForm;
use Ballot\Form\DistributionForm;
use Ballot\Form\DistrictForm;
use Ballot\Form\PartyForm;
use Ballot\Form\ReasonForm;
use Ballot\Form\Factory\BallotFormFactory;
use Ballot\Form\Factory\DistributionFormFactory;
use Ballot\Form\Factory\DistrictFormFactory;
use Ballot\Form\Factory\PartyFormFactory;
use Ballot\Form\Factory\ReasonFormFactory;
use Ballot\Service\Factory\BallotModelPrimaryAdapterFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

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
            'districts' => [
                'type' => Literal::class,
                'priority' => 1,
                'options' => [
                    'route' => '/districts',
                    'defaults' => [
                        'action' => 'index',
                        'controller' => DistrictController::class,
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
                                'controller' => DistrictController::class,
                            ],
                        ],
                    ],
                ],
            ],
            'distributions' => [
                'type' => Literal::class,
                'priority' => 1,
                'options' => [
                    'route' => '/distributions',
                    'defaults' => [
                        'action' => 'index',
                        'controller' => DistributionController::class,
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
                                'controller' => DistributionController::class,
                            ],
                        ],
                    ],
                ],
            ],
            'parties' => [
                'type' => Literal::class,
                'priority' => 1,
                'options' => [
                    'route' => '/parties',
                    'defaults' => [
                        'action' => 'index',
                        'controller' => PartyController::class,
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
                                'controller' => PartyController::class,
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
            DistrictController::class => DistrictControllerFactory::class,
            ReasonController::class => ReasonControllerFactory::class,
            DistributionController::class => DistributionControllerFactory::class,
            PartyController::class => PartyControllerFactory::class,
        ],
    ],
    'form_elements' => [
        'factories' => [
            BallotForm::class => BallotFormFactory::class,
            DistrictForm::class => DistrictFormFactory::class,
            DistributionForm::class => DistributionFormFactory::class,
            ReasonForm::class => ReasonFormFactory::class,
            PartyForm::class => PartyFormFactory::class,
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
                    [
                        'label' => 'Districts',
                        'route' => 'districts/default',
                        'class' => 'dropdown-submenu',
                        'pages' => [
                            [
                                'label' => 'Add New District',
                                'route' => 'districts/default',
                                'action' => 'create'
                            ],
                            [
                                'label' => 'List Districts',
                                'route' => 'districts/default',
                                'action' => 'index',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Distributions',
                        'route' => 'distributions/default',
                        'class' => 'dropdown-submenu',
                        'pages' => [
                            [
                                'label' => 'Add New Distribution',
                                'route' => 'distributions/default',
                                'action' => 'create'
                            ],
                            [
                                'label' => 'List Distributions',
                                'route' => 'distributions/default',
                                'action' => 'index',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Party Affiliation',
                        'route' => 'parties/default',
                        'class' => 'dropdown-submenu',
                        'pages' => [
                            [
                                'label' => 'Add New Party',
                                'route' => 'parties/default',
                                'action' => 'create'
                            ],
                            [
                                'label' => 'List Parties',
                                'route' => 'parties/default',
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