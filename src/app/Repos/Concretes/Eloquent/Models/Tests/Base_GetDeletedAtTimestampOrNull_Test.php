<?php

namespace App\Repos\Concretes\Eloquent\Models\Tests;

use App\Repos\Concretes\Eloquent\Models\Base;
use stdClass;
use Tests\TestCase;

/**
 * @codeCoverageIgnore
 */
class Base_GetDeletedAtTimestampOrNull_Test extends TestCase
{

    public function test_ok()
    {
        /* @var $base Base */
        $base = $this -> mock(Base::class . '[getAttribute]');
        $deletedAt = $this -> mock(stdClass::class);

        $base
            -> shouldReceive('getAttribute')
            -> withArgs(['deleted_at'])
            -> andReturn($deletedAt);

        $deletedAt -> timestamp = 149;

        $response = $base -> getDeletedAtTimestampOrNull();

        $this -> assertEquals(149, $response);
    }

    public function test_noDeletedAt()
    {
        /* @var $base Base */
        $base = $this -> mock(Base::class . '[getAttribute]');

        $base
            -> shouldReceive('getAttribute')
            -> withArgs(['deleted_at'])
            -> andReturnNull();

        $response = $base -> getDeletedAtTimestampOrNull();

        $this -> assertNull($response);
    }

}
