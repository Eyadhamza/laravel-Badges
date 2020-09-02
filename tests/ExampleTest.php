<?php

namespace Eyadhamza\MyFirstPackage\Tests;


use Eyadh\MyFirstPackage\Models\Badge;
use Eyadh\MyFirstPackage\Traits\HasBadges;
use Eyadh\MyFirstPackage\BadgeProvider;

use Illuminate\Foundation\Auth\User;
use Orchestra\Testbench\TestCase;

class ExampleTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        require_once __DIR__.'/../database/migrations/create_badges_table.php';
        (new \CreateBadgesTable())->up();
        $this->loadLaravelMigrations();
    }
    protected function getPackageAliases($app)
    {
        return[
            'BadgeProvider'=>\Eyadh\MyFirstPackage\Facades\BadgeProvider::class
        ];
    }

    /** @test */
    public function it_can_create_badges()
    {

        $badge =Badge::create([
            'name'=>'one-year-membership',
            'description'=>'users for more than a year'
        ]);
        $this->assertTrue($badge->exists);
    }
    /** @test */
    public function it_can_associate_badges()
    {
        $badge =Badge::create([
            'name'=>'one-year-membership',
            'description'=>'users for more than a year'
        ]);
        \BadgeProvider::grant('one-year-membership')
            ->to(TestUser::class)
            ->when(function ($user){
                return $user->created_at->lt(now()->subYear());
            });
        $user=TestUser::create([
            'name'=>'eyad',
            'email'=>'eyadhamza0@outlook.com',
            'password'=>'test',
            'created_at'=>now()->subMonths(12)
        ]);

        $this->assertCount(1,$user->badges);
    }
}

class TestUser extends User
{
    use HasBadges;

    protected $table='users';
    protected $guarded=[];
}
