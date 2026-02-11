<?php
declare(strict_types = 1);
namespace Tests\Unit;

use App\Exception\RouteNotFoundException;
use App\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase/*-->provide the funtionolty of test*/{
    

    private Router $router;
    protected function setUp(): void
    {
        parent::setUp();
        $this->router = new Router();
    }


    /**
     * @test
     */
    // annotation lagan bahut jaruri hai qki phpunit  ko nahi pata ki ye 
    // test  methid hai ya regular method hai

    public function it_registers_a_route():void{

    // A pattern we use to test is:-
    //      ----------------------------------
    //      |     GIVEN -> WHEN -> THEN       |
    //      |     ARRENGE -> ACT -> ASSERT    |
    //      -----------------------------------


        // given that we have a router object
        // $router = new Router();

        // when we call a register method
        $this->router->register('get', '/users',['UserController', 'users']);

        // then we assert route was requested
        $expected = [
            'get' => [
                '/users' => ['UserController', 'users']
            ]
        ];
        $this->assertEquals($expected, $this->router->routes());
    } 
    /** 
    * @test 
    */
    public function it_registers_a_post_route():void{
        // $router = new Router();
        $this->router->post('/users',['UserController', 'users']);

        $expected = [
            'post' => [
                '/users' => ['UserController', 'users']
            ]
        ];
        $this->assertEquals($expected, $this->router->routes());
    }
    /** @test */
    public function it_registers_a_get_route():void{
    //  $router = new Router();
        $this->router->get('/users',['UserController', 'users']);

        $expected = [
            'get' => [
                '/users' => ['UserController', 'users']
            ]
        ];
        $this->assertEquals($expected, $this->router->routes());
    }


    public function test_there_are_on_routes_when_router_is_created():void {
        // $router = new Router();
        $this->assertEmpty((new Router() )->routes());
    }
    
    /**
     * @test
     * @dataProvider Tests\DataProvider\RouterDataProvider::routeNotFoundCase
     */
    public function it_throws_route_not_found_exception(
        string $requestUri,
        string $requestMethod
    ):void{
        $usersClass = new class() {
            public function delet():bool{
                return true;
            }
        };
        $this->router->post('/users', [$usersClass::class, 'store']);
        $this->router->get('/users', ['Users', 'index']);

        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve($requestMethod, $requestUri);
    }

    public function test_it_resolves_route_from_a_closure():void{
        $this->router->get('/users', fn() => [1,2,3]);

        $this->assertEquals([1,2,3], $this->router->resolve('get', '/users'));
    }

    /** @test */
    public function it_is_resolves_route_from_a_method():void{
        $usersClass = new class() {
            public function index():array{
                return [true, 2, 3];
            }
        };

        $this->router->get('/users', [$usersClass::class, 'index']);
        
        $this->assertEquals([1, 2, 3], $this->router->resolve('get', '/users'));
        
    }
}
