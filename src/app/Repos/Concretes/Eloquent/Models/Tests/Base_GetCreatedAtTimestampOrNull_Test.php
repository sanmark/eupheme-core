<?php

namespace App\Repos\Concretes\Eloquent\Models\Tests;

use App\Repos\Concretes\Eloquent\Models\Base;
use stdClass;
use Tests\TestCase;

/**
 * @codeCoverageIgnore
 */
class Base_GetCreatedAtTimestampOrNull_Test extends TestCase
{

    public function test_ok()
    {
        /* @var $base Base */
        $base = $this -> mock(Base::class . '[getAttribute]');
        $createdAt = $this -> mock(stdClass::class);

        $base
            -> shouldReceive('getAttribute')
            -> withArgs(['created_at'])
            -> andReturn($createdAt);

        $createdAt -> timestamp = 149;

        $response = $base -> getCreatedAtTimestampOrNull();

        $this -> assertEquals(149, $response);
    }

    public function test_noCreatedAt()
    {
        /* @var $base Base */
        $base = $this -> mock(Base::class . '[getAttribute]');

        $base
            -> shouldReceive('getAttribute')
            -> withArgs(['created_at'])
            -> andReturnNull();

        $response = $base -> getCreatedAtTimestampOrNull();

        $this -> assertNull($response);
    }

}
